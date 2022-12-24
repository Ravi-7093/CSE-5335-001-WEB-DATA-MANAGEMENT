<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
    <html>
        <body>
          <table border="1px solid black" >
                <tr>
                     <th>subject</th>
                     <th>course</th>
                     <th>section</th>
                     <th>title</th>
                     <th>instructor</th>
                     <th>room</th>
                     <th>building</th>

                </tr>
				<xsl:for-each select="root/course[subj/text()='MATH']">
				<tr>
				    
                    <td><xsl:value-of select="subj"/></td>
				    <td><xsl:value-of select="crse"/></td>
				    <td><xsl:value-of select="sect"/></td>
				    <td><xsl:value-of select="title"/></td>
                    <td><xsl:value-of select="instructor"/></td>
                    <td><xsl:value-of select="place//room"/></td>
                    <td><xsl:value-of select="place//building"/></td>


                </tr>
				</xsl:for-each>
            </table>
		</body>
	</html>
	</xsl:template>
</xsl:stylesheet>
