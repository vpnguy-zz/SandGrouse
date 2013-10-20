<?php
//SandGrouse Dynamic Java Applet Modifier
//Written by DaRkReD
//Licensed under the GPL

$AppletFile = GenerateString(8);
$ClassContents = "import java.applet.*;import javax.swing.JOptionPane;import java.awt.*;public class $AppletFile extends Applet{public void paint (Graphics g){JOptionPane.showMessageDialog(null, \"" . "Sandgrouse says: " . GenerateString(5) ."\", \"alert\", JOptionPane.ERROR_MESSAGE); }}";
//$ClassContents = str_replace("%ClassName%",$AppletFile,$ClassContents);
file_put_contents($AppletFile . ".java", $ClassContents); //Dirty write to file method
exec('javac ' . $AppletFile . '.java'); //Compile applet
unlink($AppletFile . '.java'); //Deletes the source file, class file cannot be delted as user still needs it

echo "<html>";
echo "<applet code='" . $AppletFile . ".class" . "'>";
echo "</applet>";
echo "</html>";

function GenerateString ($length = 8)
{
    $password = "";
    $possible = "bcdfghjkmnpqrtvwxyzABCDFGHJKLMNPQRTVWXYZ";
    $maxlength = strlen($possible);
    if ($length > $maxlength) {
      $length = $maxlength;
    }
    $i = 0; 
    while ($i < $length) { 
      $char = substr($possible, mt_rand(0, $maxlength-1), 1);
      if (!strstr($password, $char)) { 
        $password .= $char;
        $i++;
      }
    }
    return $password;
  }

?>