package lecker.lecker1;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
public class TestDataGenerator {

  public static void main(String args[]) {

	  try {
	      // establish connection to database 
	      Connection con = DriverManager.getConnection("jdbc:sqlite:../backshop.db");
          Statement stmt = con.createStatement();
          stmt.setQueryTimeout(30);  // set timeout to 30 sec.
	      
	      
	      // insert a single dataset into the database
	     try {
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chloe Spence', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	     	stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Ryker Rollins', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Devan Vincent', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Xander Medina', 2588, to_date('1984-09-07', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Justice Garcia', 2605, to_date('1971-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Salvador Holden', 1579, to_date('1965-06-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jaylen Jensen', 1825, to_date('1996-06-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Miles Burks', 1601, to_date('1972-03-06', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chelsea Cantrell', 1852, to_date('1971-04-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan King', 1998, to_date('1973-05-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Elianna Brown', 1744, to_date('1990-10-07', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Audrina Cohen', 2489, to_date('1962-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Colby Shields', 1694, to_date('1967-08-09', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Caroline Rivers', 2174, to_date('1984-02-17', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kiara Hardin', 2760, to_date('1985-07-23', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jonathan Christensen', 765, to_date('1960-12-26', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jade Gregory', 2492, to_date('1978-10-20', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dayana Mack', 903, to_date('1963-04-19', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kallie Nash', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Rey Bradley', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Campbell Christensen', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dilan Mccow', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Fracik Medina', 2588, to_date('1984-09-07', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Justice Gabriella', 2605, to_date('1971-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Salvador Dali', 1579, to_date('1965-06-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kim Li', 1825, to_date('1996-06-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Donauer Franziska', 1601, to_date('1972-03-06', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chelsea Carly', 1852, to_date('1971-04-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Leo Ching', 1998, to_date('1973-05-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Lisa Brown', 1744, to_date('1990-10-07', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Audri Cocks', 2489, to_date('1962-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Mari Avalyan', 1694, to_date('1967-08-09', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jane Raimova', 2174, to_date('1984-02-17', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Ciara Blue', 2760, to_date('1985-07-23', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jonathan Clear', 765, to_date('1960-12-26', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Natalya Barker', 2492, to_date('1978-10-20', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Andy Robbins', 903, to_date('1963-04-19', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Brynlee Langley', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Rey Brad', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Angelica Mcgowan', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chloe Likmann', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	    	stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Hermann Fuchs', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Eva Herzberger', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dima Bilan', 2588, to_date('1984-09-07', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Kaulitz', 2605, to_date('1971-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan Hufnagl', 1579, to_date('1965-06-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan James', 1825, to_date('1996-06-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Lima Deichmann', 1601, to_date('1972-03-06', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Pia Clue', 1852, to_date('1971-04-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Adolf Klimm', 1998, to_date('1973-05-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Elina Belkova', 1744, to_date('1990-10-07', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Emina Lowest', 2489, to_date('1962-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Crame Victoria', 1694, to_date('1967-08-09', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Ariana Grande', 2174, to_date('1984-02-17', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Mila Hadin', 2760, to_date('1985-07-23', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan Chrisen', 765, to_date('1960-12-26', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jade Flipps', 2492, to_date('1978-10-20', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dayana Mask', 903, to_date('1963-04-19', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Keylie Pash', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bradley Swan', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Sara Spencer', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	    	stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Rima Romins', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dilan Wincent', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kevin Fuchs', 2588, to_date('1984-09-07', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jane Lai', 2605, to_date('1971-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Eva Golden', 1579, to_date('1965-06-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Thomas Clark', 1825, to_date('1996-06-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Will Trainor', 1601, to_date('1972-03-06', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Sema Silac', 1852, to_date('1971-04-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan Berg', 1998, to_date('1973-05-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Eli Dark', 1744, to_date('1990-10-07', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Cob Cohen', 2489, to_date('1962-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Clea Pfalnz', 1694, to_date('1967-08-09', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Cari Rurcks', 2174, to_date('1984-02-17', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Waste Rate', 2760, to_date('1985-07-23', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Franz', 765, to_date('1960-12-26', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Thomas Glanz', 2492, to_date('1978-10-20', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dani Berger', 903, to_date('1963-04-19', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Quli Queen', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Plank Flin', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Sir Crima', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kristina Cherny', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Aleks Okrino', 848, to_date('1997-06-17', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan William', 2588, to_date('1984-09-07', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Ariana Lima', 2605, to_date('1971-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chan Kai', 1579, to_date('1965-06-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Amina Derkovic', 1825, to_date('1996-06-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Mila Durks', 1601, to_date('1972-03-06', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Pork Cant', 1852, to_date('1971-04-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Hermann', 1998, to_date('1973-05-27', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bo Leon', 1744, to_date('1990-10-07', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Delilah Moran', 2489, to_date('1962-03-15', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Diana Anderson', 1694, to_date('1967-08-09', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bryn Wolf', 2174, to_date('1984-02-17', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Nancy Morgan', 2760, to_date('1985-07-23', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Fletcher Norris', 765, to_date('1960-12-26', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kael Gates', 2492, to_date('1978-10-20', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Adelyn Brock', 903, to_date('1963-04-19', 'YYYY-MM-DD'),mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Zaniyah Hines', 2424, to_date('1975-10-22', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jayden Frye', 2852, to_date('1984-07-05', 'YYYY-MM-DD'), mitar_persnr.nextval, 'Lecker')");
	        
	     } catch (Exception e) {
	        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
	      }
	      
	      // check number of datasets in person table
	      ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM mitarbeiter");
	      if (rs.next()) {
	        int count = rs.getInt(1);
	        System.out.println("Number of datasets 'Mitarbeiter' : " + count);
	      }
	  
	      try {

	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12341,'Semmel', 0.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12342,'Pizza', 1.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12343,'Apfelstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12344,'Topfenstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12345,'Marillenknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12346,'Weissbrot', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12347,'Napoleon', 2.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12348,'Kaiserschmarren', 2.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12349,'Erdbeerknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12350,'Prjanik', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12351,'Vogelmilch', 2.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12352,'Tschaek-Tschaek', 1.49, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12353,'Watruschka', 0.45, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12354,'Syrniki', 0.10, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12355,'Tiramisu', 1.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12356,'Pudding', 0.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12357,'Brownie', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12358,'Panna Cotta', 1.69, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12359,'Baklava', 2, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12360,'Cupcake', 2.95, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12361,'Muraveinik', 1.25, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12362,'Donut', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12363,'Mischbrot', 1.09, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12364,'Tost', 0.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12365,'Lebkuchen', 1.59, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
            
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12366,'Semmel', 0.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12367,'Pizza', 1.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12368,'Apfelstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12369,'Topfenstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12370,'Marillenknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12371,'Weissbrot', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12372,'Napoleon', 2.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12373,'Kaiserschmarren', 2.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12374,'Erdbeerknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12375,'Prjanik', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12376,'Vogelmilch', 2.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12377,'Tschaek-Tschaek', 1.49, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12378,'Watruschka', 0.45, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12379,'Syrniki', 0.10, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12380,'Tiramisu', 1.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12381,'Pudding', 0.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12382,'Brownie', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12383,'Panna Cotta', 1.69, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12384,'Baklava', 2, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12385,'Cupcake', 2.95, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12386,'Muraveinik', 1.25, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12387,'Donut', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12388,'Mischbrot', 1.09, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12389,'Tost', 0.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12390,'Lebkuchen', 1.59, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");

	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12391,'Semmel', 0.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12392,'Pizza', 1.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12393,'Apfelstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12394,'Topfenstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12395,'Marillenknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12396,'Weissbrot', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12397,'Napoleon', 2.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12398,'Kaiserschmarren', 2.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12399,'Erdbeerknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12400,'Prjanik', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12401,'Vogelmilch', 2.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12402,'Tschaek-Tschaek', 1.49, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12403,'Watruschka', 0.45, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12404,'Syrniki', 0.10, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12405,'Tiramisu', 1.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12406,'Pudding', 0.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12407,'Brownie', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12408,'Panna Cotta', 1.69, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12409,'Baklava', 2, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12410,'Cupcake', 2.95, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12411,'Muraveinik', 1.25, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12412,'Donut', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12413,'Mischbrot', 1.09, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12414,'Tost', 0.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12415,'Lebkuchen', 1.59, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
            
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12416,'Semmel', 0.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12417,'Pizza', 1.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12418,'Apfelstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12419,'Topfenstrudel', 1.75, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12420,'Marillenknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12421,'Weissbrot', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12422,'Napoleon', 2.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12423,'Kaiserschmarren', 2.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12424,'Erdbeerknoedel', 1.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12425,'Prjanik', 1.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12426,'Vogelmilch', 2.15, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12427,'Tschaek-Tschaek', 1.49, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12428,'Watruschka', 0.45, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12429,'Syrniki', 0.10, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12430,'Tiramisu', 1.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12431,'Pudding', 0.55, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12432,'Brownie', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12433,'Panna Cotta', 1.69, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12434,'Baklava', 2, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12435,'Cupcake', 2.95, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12436,'Muraveinik', 1.25, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12437,'Donut', 0.89, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12438,'Mischbrot', 1.09, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12439,'Tost', 0.99, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");
	        stmt.executeUpdate("INSERT INTO backwaren VALUES (12440,'Lebkuchen', 1.59, TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'))");

	        
	      } catch (Exception e) {
	        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
	      }

	      ResultSet rd = stmt.executeQuery("SELECT COUNT(*) FROM backwaren");
	      if (rd.next()) {
	        int count = rd.getInt(1);
	        System.out.println("Number of datasets 'Backwaren' : " + count);
	      }
	      
	      
	      try {
		        /*String insertSql = "INSERT INTO person VALUES ('012345678901', 'Erich', 'Schikuta', 'Wien', 1010, 'Rathausstrasse 19', '12-FEB-2000', 'Wien')";
		        stmt.executeUpdate(insertSql);*/
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Chloe Spence', 2, 'Kochschule', 15.0, 'Der Ofen')");
		    	stmt.executeUpdate("INSERT INTO konditor VALUES ('Ryker Rollins', 2, 'Kochschule', 15.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Devan Vincent', 8,'Kochschule', 30.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Xander Medina', 3, 'Kochschule', 15.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Justice Garcia', 4, 'Kochschule', 18.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Salvador Holden', 1, 'Kochschule', 10.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Jaylen Jensen', 3, 'Kochschule', 15.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Miles Burks', 5, 'Kochschule', 30.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Chelsea Cantrell', 4, 'Kochschule', 18.0, 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO konditor VALUES ('Johan King', 2,  'Kochschule', 18.0, 'Der Ofen')");
		        
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Elianna Brown', 'Vormittag', to_date('2015-10-07', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Audrina Cohen', 'Vormittag', to_date('2016-03-15', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Colby Shields', 'Vormittag', to_date('2015-08-09', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Caroline Rivers', 'Nachmittag', to_date('2016-02-17', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Kiara Hardin', 'Nachmittag', to_date('2015-07-23', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Jonathan Christensen','Vormittag', to_date('2015-12-26', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Jade Gregory', 'Nachmittag', to_date('2016-10-20', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Dayana Mack', 'Vormittag', to_date('2015-04-19', 'YYYY-MM-DD'),'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Kallie Nash', 'Nachmittag', to_date('2016-10-22', 'YYYY-MM-DD'), 'Kasack', 'Der Ofen')");
		        stmt.executeUpdate("INSERT INTO kuechengehilfe VALUES ('Rey Bradley', 'Nachmittag', to_date('2016-07-05', 'YYYY-MM-DD'), 'Kasack', 'Der Ofen')");
		      
		        
		     } catch (Exception e) {
		        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
		      }
		      
		      // check number of datasets in person table
		      ResultSet rb = stmt.executeQuery("SELECT COUNT(*) FROM konditor");
		      if (rb.next()) {
		        int count = rb.getInt(1);
		        System.out.println("Number of datasets 'Konditor' : " + count);
		      }
		      
		      ResultSet rf = stmt.executeQuery("SELECT COUNT(*) FROM kuechengehilfe");
		      if (rf.next()) {
		        int count = rf.getInt(1);
		        System.out.println("Number of datasets 'Kuechengehilfe' : " + count);
		      }
		  	      
		      
		      try {
			       
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Chloe Spence', 12341)");
			    	stmt.executeUpdate("INSERT INTO backen VALUES ('Ryker Rollins', 12342)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Devan Vincent',12343)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Xander Medina', 12344)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Justice Garcia', 12345)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Salvador Holden', 12346)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Jaylen Jensen', 12347)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Miles Burks', 12348)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Chelsea Cantrell', 12349)");
			        stmt.executeUpdate("INSERT INTO backen VALUES ('Johan King', 12350)");
			        
			     } catch (Exception e) {
			        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
			      }
			      
			      // check number of datasets in person table
			      ResultSet rbb = stmt.executeQuery("SELECT COUNT(*) FROM backen");
			      if (rbb.next()) {
			        int count = rbb.getInt(1);
			        System.out.println("Number of datasets 'Backen': " + count);
			      }
			      
			      
			      PreparedStatement pstm = null;
			       
			      for (int i = 1; i <= 1000; i++) {
			    	String sql = "INSERT INTO kunde VALUES('" + "Kunde" + i + "','" + "kunde"+i+"@gmail.com" + "'," + "to_date('1975-10-22', 'YYYY-MM-DD')" + ",'" + "Lecker" + "')";
			         pstm=con.prepareStatement(sql);
				       pstm.executeUpdate();
				       pstm.close();
			      }
			      
			      for (int i = 1; i <= 1000; i++) {
			    	//  for(double j=0.10; j <=10; j++){
				    	String sql = "INSERT INTO produkt VALUES(" + "0741852" + i + ",'" + "Produkt"+i + "'," + i + "," + "TO_DATE('20161120', 'YYYYMMDD'), TO_DATE('20161123', 'YYYYMMDD'), 5.3)";
				         pstm=con.prepareStatement(sql);
					       pstm.executeUpdate();
					       pstm.close();
				      }//}
	      
			      			      
			   // check number of datasets in person table
			      ResultSet rk = stmt.executeQuery("SELECT COUNT(*) FROM kunde");
			      if (rk.next()) {
			        int count = rk.getInt(1);
			        System.out.println("Number of datasets 'Kunde': " + count);
			      }
			      
			   // check number of datasets in person table
			      ResultSet rp = stmt.executeQuery("SELECT COUNT(*) FROM produkt");
			      if (rp.next()) {
			        int count = rp.getInt(1);
			        System.out.println("Number of datasets 'Produkt': " + count);
			      }
			      
			      try {
				       
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde1', 12341)");
				    	stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde2', 12342)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde3',12343)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde4', 12344)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde5', 12345)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde6', 12346)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde7', 12347)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde8', 12348)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde9', 12349)");
				        stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde10', 12350)");
				        
				     } catch (Exception e) {
				        System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
				      }
			      
			   // check number of datasets in person table
			      ResultSet re = stmt.executeQuery("SELECT COUNT(*) FROM einkauf");
			      if (re.next()) {
			        int count = re.getInt(1);
			        System.out.println("Number of datasets 'Einkauf': " + count);
			      }
				      
			      for (int i = 1; i <= 9; i++) {
					    	String sql = "INSERT INTO bestandteil VALUES(" + "1234" + i + "," + "0741852" + i+")";
					         pstm=con.prepareStatement(sql);
						       pstm.executeUpdate();
						       pstm.close();
					      }
			      
			   // check number of datasets in person table
			      ResultSet bt = stmt.executeQuery("SELECT COUNT(*) FROM bestandteil");
			      if (bt.next()) {
			        int count = bt.getInt(1);
			        System.out.println("Number of datasets 'Bestandteil': " + count);
			      }
			      
	      // clean up connections
	      bt.close();
		  re.close();
		  rf.close();
	      rs.close();
	      rb.close();
	      rd.close();
	      rk.close();
	      rp.close();
	      pstm.close();
	      stmt.close();
	      con.close();

	    } catch (Exception e) {
	      System.err.println(e.getMessage());
	    }
  }
}

