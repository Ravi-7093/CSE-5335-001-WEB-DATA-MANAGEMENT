// Online Java Compiler
// Use this editor to write, compile and run your Java code online
import javax.xml.parsers.*;
import org.w3c.dom.*;
import java.net.URL;
import java.util.HashSet;
import java.util.ArrayList;
class Dom {
     
    public static void main(String[] args) throws Exception {
        DocumentBuilderFactory dbf = DocumentBuilderFactory.newInstance();
        DocumentBuilder db = dbf.newDocumentBuilder();
        Document doc = db.parse((new URL("http://aiweb.cs.washington.edu/research/projects/xmltk/xmldata/data/courses/reed.xml")).openStream());
        HashSet<String> myres = new HashSet<>();
        Node root = doc.getDocumentElement();
        NodeList mylist = doc.getElementsByTagName("course");
        for (int i = 0; i < mylist.getLength(); i++) {
            Node nNode = mylist.item(i);
            Element eElement = (Element) nNode;
            String mycourse = eElement.getElementsByTagName("subj").item(0).getTextContent();
            String courseroom = eElement.getElementsByTagName("room").item(0).getTextContent();
            String coursebuilding = eElement.getElementsByTagName("building").item(0).getTextContent();
	        	if(mycourse.equals("MATH") &&  courseroom.equals("204") && coursebuilding.equals("LIB")) {
	        		myres.add(eElement.getElementsByTagName("title").item(0).getTextContent());
	        	}
            }
            System.out.println("The Math courses tiles taught in room LIB 204:");
            System.out.println();
            ArrayList<String> finalres = new ArrayList<>(myres);
            for(int i=0; i<finalres.size();i++){
                System.out.println(finalres.get(i));
            }
 
}
}