import java.awt.*;
import java.awt.event.*;
import java.awt.image.*;
import java.io.*;
import javax.imageio.*;
import javax.swing.*;


public class imagesMerge {

public static void main(String[] args) {

// File path
String path="";

try
{
// Chargement des images
System.out.println("Chargement Image Brute JPG");
BufferedImage imageBrute = ImageIO.read(new File("nom_image_brute.jpg"));

System.out.println("Chargement Image Print Template PNG");
BufferedImage printTemplate = ImageIO.read(new File("nom_print_template.png"));

// Cr�ation d'une image vide qui contiendra l'image brute et le print template
System.out.println("G�n�ration image R�sultat");
int l = 1014;
int h = 642;
BufferedImage imageResultat = new BufferedImage(l, h, BufferedImage.TYPE_INT_RGB);

// Merge de l'image brute et du print template
Graphics g = imageResultat.getGraphics();
g.drawImage(imageBrute, 0, 0, null);
g.drawImage(printTemplate, 0, 0, null);

// Enregistrement de l'image
ImageIO.write(imageResultat, "JPG", new File("nom_image_resultat.jpg"));

}
catch (IOException e)     
{

 System.out.println("Erreur");
 System.out.println(e);
// log the exception      
// re-throw if desired
}

}


}