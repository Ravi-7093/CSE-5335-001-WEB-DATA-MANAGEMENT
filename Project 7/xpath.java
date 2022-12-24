
import javax.xml.parsers.*;
import org.w3c.dom.*;
import java.net.URL;
import java.util.ArrayList;
import javax.xml.xpath.*;
import java.util.*;

class HelloWorld {

    static void check_expression(String expression_one) throws Exception {
        DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
        DocumentBuilder db = dbf.newDocumentBuilder();
        Document doc = db
                .parse((new URL("http://aiweb.cs.washington.edu/research/projects/xmltk/xmldata/data/courses/reed.xml"))
                        .openStream());
        XPathFactory xpathFactory = XPathFactory.newInstance();
        XPath xpath = xpathFactory.newXPath();
        HashSet<String> myres = new HashSet<>();
        NodeList result = (NodeList) xpath.evaluate(expression_one, doc, XPathConstants.NODESET);
        for (int i = 0; i < result.getLength(); i++) {
            myres.add(result.item(i).getTextContent());
        }
        ArrayList<String> finalres = new ArrayList<>(myres);
        System.out.println("The Math courses tiles taught in room LIB 204:");
        System.out.println();

        for (int i = 0; i < finalres.size(); i++) {
            System.out.println(finalres.get(i));
        }
        System.out.println();
    }
    static void check_expression_inst(String expression_two) throws Exception {
        DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
        DocumentBuilder db = dbf.newDocumentBuilder();
        Document doc = db
                .parse((new URL("http://aiweb.cs.washington.edu/research/projects/xmltk/xmldata/data/courses/reed.xml"))
                        .openStream());
        XPathFactory xpathFactory = XPathFactory.newInstance();
        XPath xpath = xpathFactory.newXPath();
        HashSet<String> myres = new HashSet<>();
        NodeList result = (NodeList) xpath.evaluate(expression_two, doc, XPathConstants.NODESET);
        for (int i = 0; i < result.getLength(); i++) {
            myres.add(result.item(i).getTextContent());
        }
        ArrayList<String> finalres = new ArrayList<>(myres);
       
        System.out.println("The Math courses tiles taught in room LIB 412:");
        System.out.println();

        for (int i = 0; i < finalres.size(); i++) {
            System.out.println(finalres.get(i));
        }
        System.out.println();
    }
    static void check_expression_crs(String expression_three) throws Exception {
        DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
        DocumentBuilder db = dbf.newDocumentBuilder();
        Document doc = db
                .parse((new URL("http://aiweb.cs.washington.edu/research/projects/xmltk/xmldata/data/courses/reed.xml"))
                        .openStream());
        XPathFactory xpathFactory = XPathFactory.newInstance();
        XPath xpath = xpathFactory.newXPath();
        HashSet<String> myres = new HashSet<>();
        NodeList result = (NodeList) xpath.evaluate(expression_three, doc, XPathConstants.NODESET);
        for (int i = 0; i < result.getLength(); i++) {
            myres.add(result.item(i).getTextContent());
        }
        ArrayList<String> finalres = new ArrayList<>(myres);
       
        System.out.println("The Math courses tiles by Wieting:");
        System.out.println();

        for (int i = 0; i < finalres.size(); i++) {
            System.out.println(finalres.get(i));
        }
        System.out.println();
    }

    public static void main(String[] args) throws Exception{
      String expression_one="/root/course[subj/text()='MATH' and place//room/text()='204' and place//building/text()='LIB']/title";
      String expression_two="/root/course[subj/text()='MATH' and crse/text()='412' ]/instructor";
      String expression_three="/root/course[instructor/text()='Wieting' ]/title";

      check_expression(expression_one);
      check_expression_inst(expression_two);
      check_expression_crs(expression_three);
    }
}