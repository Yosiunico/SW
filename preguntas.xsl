<?xml version="1.0" ?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
    <xsl:template match="/">
        <html>
            <body>
                <table border="1">
                    <thead>
                        <tr> <th>ENUNCIADO</th> <th>RESPUESTA CORRECTA</th> <th>RESPUESTAS INCORRECTAS</th> </tr>
                    </thead>
                    <xsl:for-each select="/assessmentItems/assessmentItem" >
                        <tr>
                            <td>
                                <xsl:value-of select="itemBody/p"/>
                            </td>
                            <td>
                                <xsl:value-of select="correctResponse/value"/>
                            </td>
                            <td>
                                <ol>
                                    <xsl:for-each select="incorrectResponses/value">
                                        <li><xsl:value-of select="."/></li>
                                    </xsl:for-each>
                                </ol>
                            </td>
                        </tr>
                    </xsl:for-each>
                </table>
        </body>
        </html>
    </xsl:template>
</xsl:stylesheet>