/***************************************************************************
 * 
 * Based heavily on:
 * Globus Developers Tutorial: GridFTP Example - Simple Authenticated Put
 *
 * Original code found at:
 * http://www-unix.globus.org/mail_archive/discuss/2002/10/msg00631.html
 *
 ***************************************************************************/
#include <stdio.h>
#include "globus_ftp_client.h"

static globus_mutex_t lock;
static globus_cond_t cond;
static globus_bool_t done;

#define MAX_BUFFER_SIZE 2048

static void done_cb(void *user_arg,
                    globus_ftp_client_handle_t *handle,
                    globus_object_t *err)
{
    FILE *fd = (FILE *)user_arg;
    if (err)
    {
        fprintf(stderr,"%s", globus_object_printable_to_string(err));
    }
    else if (fd)
    {
        fclose(fd);
    }
    globus_mutex_lock(&lock);
    done = GLOBUS_TRUE;
    globus_cond_signal(&cond);
    globus_mutex_unlock(&lock);
    return;
}

static void data_cb(void *user_arg,
                    globus_ftp_client_handle_t *handle,
                    globus_object_t *err,
                    globus_byte_t *buffer,
                    globus_size_t length,
                    globus_off_t offset,
                    globus_bool_t eof)
{
    FILE *fd = (FILE *) user_arg;
    if (err)
    {
        fprintf(stderr,"%s",globus_object_printable_to_string(err));
    }
    else
    {
        globus_assert(fd);
        fwrite(buffer, 1, length, fd);
        if (ferror(fd) != 0)
        {
            printf("Write error in function data_cb; errno = %d\n",errno);
            return;
        }
        globus_ftp_client_register_read(handle,buffer,MAX_BUFFER_SIZE,
                                        data_cb,(void *) fd);
    }
    return;
}

int main(int argc, char **argv)
{
    globus_result_t result = (globus_result_t)0;
    globus_ftp_client_handle_t handle;
    globus_byte_t buffer[MAX_BUFFER_SIZE];
    char *src = (char *)0;
    char *dst = (char *)0;
    FILE *fd = (FILE *)0;

    if (argc != 3)
    {
        printf("Usage: gftp_get <source-url> <local-file>\n");
        return 1;
    }
    else
    {
        src = argv[1];
        dst = argv[2];
    }

    fd = fopen(dst,"w");
    if (fd == (FILE *)0)
    {
        printf("Error opening local file: %s\n",src);
        return 1;
	
    }

    globus_module_activate(GLOBUS_FTP_CLIENT_MODULE);
    globus_mutex_init(&lock,GLOBUS_NULL);
    globus_cond_init(&cond,GLOBUS_NULL);
    globus_ftp_client_handle_init(&handle,GLOBUS_NULL);

    done = GLOBUS_FALSE;
    
    result = globus_ftp_client_get(&handle,src,GLOBUS_NULL,GLOBUS_NULL,
                                   done_cb,(void *)fd);
    if (result != GLOBUS_SUCCESS)
    {
        globus_object_t *err = globus_error_get(result);
        fprintf(stderr,"%s", globus_object_printable_to_string(err));
        done = GLOBUS_TRUE;
    }
    else
    {
        memset(buffer,0,MAX_BUFFER_SIZE);
        globus_ftp_client_register_read(&handle,buffer,MAX_BUFFER_SIZE,
                                        data_cb,(void *)fd);
    }

    globus_mutex_lock(&lock);
    while(!done)
    {
        globus_cond_wait(&cond, &lock);
    }
    globus_mutex_unlock(&lock);

    globus_ftp_client_handle_destroy(&handle);
    globus_module_deactivate_all();

    return 0;

}


