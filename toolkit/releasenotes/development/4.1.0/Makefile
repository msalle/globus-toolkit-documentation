export UMASK=002
export XML_CATALOG_FILES=../../../docs/development/4.1.0/catalog
#export XML_DEBUG_CATALOG= 1
FILENAME= index.xml

all: html

html:
	xsltproc --xinclude \
	--catalogs \
	custom_html.xsl  \
	${FILENAME}

debian-sarge:
	xsltproc --stringparam chunk.section.depth 0 \
	/usr/share/xml/docbook/stylesheet/nwalsh/html/chunk.xsl \
	$(FILENAME)
	
	mac:
	xsltproc --stringparam chunk.section.depth 0 \
	--stringparam chapter.autolabel 0 \
	/sw/share/xml/xsl/docbook-xsl/html/chunk.xsl \
	$(FILENAME)
	