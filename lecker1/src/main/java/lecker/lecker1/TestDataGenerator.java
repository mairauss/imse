package lecker.lecker1;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.Statement;
import java.util.concurrent.atomic.AtomicInteger;

public class TestDataGenerator {

	public static void main(String args[]) {

		try {
			// establish connection to database
			Connection con = DriverManager.getConnection("jdbc:sqlite:../backshop.db");
			Statement stmt = con.createStatement();
			stmt.setQueryTimeout(30); // set timeout to 30 sec.

		stmt.executeUpdate("INSERT INTO baeckerei VALUES ('Lecker', 841101)");
			stmt.executeUpdate("INSERT INTO anschrift VALUES ('Lecker', 'Wien, 1200, Wehlistraße 27')");
			stmt.executeUpdate("INSERT INTO kuehlraum VALUES (123, 4, 18.3)");
			stmt.executeUpdate("INSERT INTO kueche VALUES (987, 32.2, 123)");
			stmt.executeUpdate("INSERT INTO kuechenzeile VALUES (987, 'irgendetwas')");

			// MITARBEITER
			try {
				AtomicInteger id = new AtomicInteger(100);
				AtomicInteger id2 = new AtomicInteger(100);
				AtomicInteger id3 = new AtomicInteger(100);

				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Mari Avalyan', 1694, '1967-08-09',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Franz', 765, '1960-12-26',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Devan Vincent', 848, '1997-06-17',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Xander Medina', 2588, '1984-09-07',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Justice Garcia', 2605, '1971-03-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Salvador Holden', 1579, '1965-06-27',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jaylen Jensen', 1825, '1996-06-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Miles Burks', 1601, '1972-03-06',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chelsea Cantrell', 1852, '1971-04-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan King', 1998, '1973-05-27',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Elianna Brown', 1744, '1990-10-07',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Audrina Cohen', 2489, '1962-03-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Colby Shields', 1694,'1967-08-09',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Caroline Rivers', 2174, '1984-02-17',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kiara Hardin', 2760, '1985-07-23',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jonathan Christensen', 765, '1960-12-26',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Jade Gregory', 2492, '1978-10-20',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dayana Mack', 903, '1963-04-19',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kallie Nash', 2424, '1975-10-22',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Rey Bradley', 2852, '1984-07-05',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Campbell Christensen', 848, '1997-06-17',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Dilan Mccow', 848, '1997-06-17',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Fracik Medina', 2588, '1984-09-07',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Justice Gabriella', 2605, '1971-03-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Salvador Dali', 1579, '1965-06-27',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Kim Li', 1825, '1996-06-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Donauer Franziska', 1601, '1972-03-06',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Chelsea Carly', 1852, '1971-04-15',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Leo Ching', 1998, '1973-05-27',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				stmt.executeUpdate("INSERT INTO mitarbeiter VALUES ('Lisa Brown', 1744, '1990-10-07',"
						+ id.getAndIncrement() + ", 'Lecker','pass"+ id2.getAndIncrement() + "'," + 9 + "," + "'mitarbeiter" + id3.getAndIncrement() + "@gmail.com'" + ")");
				/*
				 * stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Audri Cocks', 2489, '1962-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Jane Raimova', 2174, '1984-02-17',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Ciara Blue', 2760, '1985-07-23',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Jonathan Clear', 765, '1960-12-26',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Natalya Barker', 2492, '1978-10-20',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Andy Robbins', 903, '1963-04-19',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Brynlee Langley', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Rey Brad', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Angelica Mcgowan', 848, '1997-06-17', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Chloe Likmann', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Hermann Fuchs', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Eva Herzberger', 848, '1997-06-17', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Dima Bilan', 2588, '1984-09-07', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Kaulitz', 2605, '1971-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan Hufnagl', 1579, '1965-06-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan James', 1825, '1996-06-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Lima Deichmann', 1601, '1972-03-06',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Pia Clue', 1852, '1971-04-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Adolf Klimm', 1998, '1973-05-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Elina Belkova', 1744, '1990-10-07',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Emina Lowest', 2489, '1962-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Crame Victoria', 1694, '1967-08-09',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Ariana Grande', 2174, '1984-02-17',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Mila Hadin', 2760, '1985-07-23',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan Chrisen', 765, '1960-12-26',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Jade Flipps', 2492, '1978-10-20',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Dayana Mask', 903, '1963-04-19',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Keylie Pash', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Bradley Swan', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Sara Spencer', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Rima Romins', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Dilan Wincent', 848, '1997-06-17', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Kevin Fuchs', 2588, '1984-09-07', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Jane Lai', 2605, '1971-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Eva Golden', 1579, '1965-06-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Thomas Clark', 1825, '1996-06-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Will Trainor', 1601, '1972-03-06',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Sema Silac', 1852, '1971-04-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Johan Berg', 1998, '1973-05-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Eli Dark', 1744, '1990-10-07',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Cob Cohen', 2489, '1962-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Clea Pfalnz', 1694, '1967-08-09',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Cari Rurcks', 2174, '1984-02-17',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Waste Rate', 2760, '1985-07-23',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Dani Berger', 903, '1963-04-19',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Quli Queen', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Plank Flin', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Sir Crima', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Kristina Cherny', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Aleks Okrino', 848, '1997-06-17', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Stefan William', 2588, '1984-09-07', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Ariana Lima', 2605, '1971-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Chan Kai', 1579, '1965-06-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Amina Derkovic', 1825, '1996-06-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Mila Durks', 1601, '1972-03-06',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Pork Cant', 1852, '1971-04-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Bill Hermann', 1998, '1973-05-27',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Bo Leon', 1744, '1990-10-07',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Delilah Moran', 2489, '1962-03-15',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Diana Anderson', 1694, '1967-08-09',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Bryn Wolf', 2174, '1984-02-17',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Nancy Morgan', 2760, '1985-07-23',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Fletcher Norris', 765, '1960-12-26',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Kael Gates', 2492, '1978-10-20',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Adelyn Brock', 903, '1963-04-19',"
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Zaniyah Hines', 2424, '1975-10-22', "
				 * + id.getAndIncrement()+", 'Lecker')"); stmt.
				 * executeUpdate("INSERT INTO mitarbeiter VALUES ('Jayden Frye', 2852, '1984-07-05', "
				 * + id.getAndIncrement()+", 'Lecker')");
				 */
			} catch (Exception e) {
				System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
			}

			// check number of datasets in person table
			ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM mitarbeiter");
			if (rs.next()) {
				int count = rs.getInt(1);
				System.out.println("Number of datasets 'Mitarbeiter' : " + count);
			}

		// BACKWAREN
		try {
			AtomicInteger artNr = new AtomicInteger(1000);

			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Semmel', 0.15, '2018-01-20', '2018-01-23', 50)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Honigtorte', 2.15, '2018-01-20', '2018-01-23', 20)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Apfelstrudel', 1.75, '2018-01-20','2018-01-23', 15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Topfenstrudel', 1.75, '2018-01-20','2018-01-23', 15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Marillenknoedel', 1.89, '2018-01-20', '2018-01-23', 15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Nussschnecke', 1.99, '2018-01-20', '2018-01-23', 30)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Napoleon', 2.99, '2018-01-20','2018-01-23', 10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Palatschinken', 2.0, '2018-01-20', '2018-01-23', 50)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Erdbeerknoedel', 1.89, '2018-01-20', '2018-01-23', 15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Lebkuchen', 1.99, '2018-01-20','2018-01-23', 20)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Vogelmilchtorte', 2.15, '2018-01-20','2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Tschaek-Tschaek', 1.49, '2018-01-20', '2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Watruschki', 0.45, '2018-01-20','2018-01-23',30)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Syrniki', 0.30, '2018-01-20', '2018-01-23',50)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Tiramisu', 2.55, '2018-01-20','2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Pudding', 0.75, '2018-01-20', '2018-01-23', 30)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Brownie', 1.89, '2018-01-20', '2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Panna Cotta', 1.09, '2018-01-20', '2018-01-23', 15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Baklava', 2.50, '2018-01-20','2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Cupcake', 2.95,'2018-01-20', '2018-01-23',20)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Muraveinik', 1.85, '2018-01-20', '2018-01-23',15)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Donut', 0.99,'2018-01-20','2018-01-23', 30)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Bananenschnitte', 3.0, '2018-01-20', '2018-01-23',10)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Buttercroissant', 0.49,'2018-01-20', '2018-01-23',20)");
			stmt.executeUpdate("INSERT INTO backwaren VALUES (" + artNr.getAndIncrement()
					+ ",'Bananen-Nutella Croissant', 0.89, '2018-01-20', '2018-01-23',10)");

		} catch (Exception e) {
			System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
		}

		ResultSet rd = stmt.executeQuery("SELECT COUNT(*) FROM backwaren");
		if (rd.next()) {
			int count = rd.getInt(1);
			System.out.println("Number of datasets 'Backwaren' : " + count);
		}

		PreparedStatement pstm = null;

		// KONDITOR && KÜCHENGEHILFE
		try {
			AtomicInteger id3 = new AtomicInteger(100);
			for (int i = 0; i < 20; i++) {
				if (i < 10) {
					String sql = "INSERT INTO konditor VALUES(" + 10 + i + "," + i + ",'Kochschule'," + 1 + i
							+ ",'mitarbeiter" + id3.getAndIncrement() + "@gmail.com', 987)";
					pstm = con.prepareStatement(sql);
					pstm.executeUpdate();
					pstm.close();
				} else {
					String sql = "INSERT INTO konditor VALUES(" + 1 + i + "," + i + ",'Kochschule',"  + i
							+ ",'mitarbeiter" + id3.getAndIncrement() + "@gmail.com', 987)";
					pstm = con.prepareStatement(sql);
					pstm.executeUpdate();
					pstm.close();
				}
			}

			/*
			 * stmt.
			 * executeUpdate("INSERT INTO konditor VALUES (100, 2, 'Kochschule', 15.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES (101, 2, 'Kochschule', 15.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES (102, 8,'Kochschule', 30.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Xander Medina', 3, 'Kochschule', 15.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Justice Garcia', 4, 'Kochschule', 18.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Salvador Holden', 1, 'Kochschule', 10.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Jaylen Jensen', 3, 'Kochschule', 15.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Miles Burks', 5, 'Kochschule', 30.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Chelsea Cantrell', 4, 'Kochschule', 18.0, 987)"
			 * ); stmt.
			 * executeUpdate("INSERT INTO konditor VALUES ('Johan King', 2,  'Kochschule', 18.0, 987)"
			 * );
			 */

			for (int i = 20; i < 25; i++) {
				String sql = "INSERT INTO kuechengehilfe VALUES(" + 1 + i + ",'Vormittag'"+
			    ",'mitarbeiter" + id3.getAndIncrement() + "@gmail.com', 987)";
				pstm = con.prepareStatement(sql);
				pstm.executeUpdate();
				pstm.close();
			}

			for (int i = 25; i < 30; i++) {
				String sql = "INSERT INTO kuechengehilfe VALUES(" + 1 + i + ",'Nachmittag'"+ 
			    ",'mitarbeiter" + id3.getAndIncrement() + "@gmail.com', 987)";
				pstm = con.prepareStatement(sql);
				pstm.executeUpdate();
				pstm.close();
			}

			/*
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (120, 'Nachmittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (121, 'Vormittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (122, 'Vormittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (123, 'Vormittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (124, 'Nachmittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (125, 'Nachmittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (126, 'Vormittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (127, 'Nachmittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (128, 'Vormittag', 987)");
			 * stmt.
			 * executeUpdate("INSERT INTO kuechengehilfe VALUES (129, 'Nachmittag', 987)");
			 */

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

		// BACKEN
		try {
			/*
			 * for (int i = 0; i < 20; i++) { if(i<10) { String sql =
			 * "INSERT INTO backen VALUES(" + 10+i +","+ 100+i + ")";
			 * pstm=con.prepareStatement(sql); pstm.executeUpdate(); pstm.close(); }else {
			 * String sql = "INSERT INTO backen VALUES(" + 1+i +","+ 10+i + ")";
			 * pstm=con.prepareStatement(sql); pstm.executeUpdate(); pstm.close(); } }
			 */

			stmt.executeUpdate("INSERT INTO backen VALUES (100, 1000)");
			stmt.executeUpdate("INSERT INTO backen VALUES (120, 1001)");
			stmt.executeUpdate("INSERT INTO backen VALUES (101, 1002)");
			stmt.executeUpdate("INSERT INTO backen VALUES (101, 1003)");
			stmt.executeUpdate("INSERT INTO backen VALUES (102, 1004)");
			stmt.executeUpdate("INSERT INTO backen VALUES (103, 1005)");
			stmt.executeUpdate("INSERT INTO backen VALUES (118, 1006)");
			stmt.executeUpdate("INSERT INTO backen VALUES (104, 1007)");
			stmt.executeUpdate("INSERT INTO backen VALUES (100, 1008)");
			stmt.executeUpdate("INSERT INTO backen VALUES (117, 1009)");
			stmt.executeUpdate("INSERT INTO backen VALUES (119, 1010)");
			stmt.executeUpdate("INSERT INTO backen VALUES (105, 1011)");
			stmt.executeUpdate("INSERT INTO backen VALUES (106, 1012)");
			stmt.executeUpdate("INSERT INTO backen VALUES (107, 1013)");
			stmt.executeUpdate("INSERT INTO backen VALUES (108, 1014)");
			stmt.executeUpdate("INSERT INTO backen VALUES (109, 1015)");
			stmt.executeUpdate("INSERT INTO backen VALUES (110, 1016)");
			stmt.executeUpdate("INSERT INTO backen VALUES (111, 1017)");
			stmt.executeUpdate("INSERT INTO backen VALUES (112, 1018)");
			stmt.executeUpdate("INSERT INTO backen VALUES (113, 1019)");
			stmt.executeUpdate("INSERT INTO backen VALUES (114, 1020)");
			stmt.executeUpdate("INSERT INTO backen VALUES (115, 1021)");
			stmt.executeUpdate("INSERT INTO backen VALUES (116, 1022)");
			stmt.executeUpdate("INSERT INTO backen VALUES (108, 1023)");
			stmt.executeUpdate("INSERT INTO backen VALUES (108, 1024)");

		} catch (Exception e) {
			System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
		}

		// check number of datasets in person table
		ResultSet rbb = stmt.executeQuery("SELECT COUNT(*) FROM backen");
		if (rbb.next()) {
			int count = rbb.getInt(1);
			System.out.println("Number of datasets 'Backen': " + count);
		}

		// KUNDE
		for (int i = 1; i < 101; i++) {
			String sql = "INSERT INTO kunde VALUES('" + "Kunde" + i + "','" + "kunde" + i 
			+ "@gmail.com" + "'," + "1975-10-22" + ",'" + "Lecker" + "','" + "pass" + i + "'" + "," + 1 +")";
			pstm = con.prepareStatement(sql);
			pstm.executeUpdate();
			pstm.close();
		}

		// PRODUKT
		/*
		 * for (int i = 1; i < 101; i++) { String sql = "INSERT INTO produkt VALUES(" +
		 * "074185" + i + ",'" + "Produkt"+i + "', 2.3 ,'2018-01-20', '2018-01-23'," +
		 * 10+i + ",123)"; pstm=con.prepareStatement(sql); pstm.executeUpdate();
		 * pstm.close(); }
		 */
		AtomicInteger artNr = new AtomicInteger(78961);

		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Salz', 0.30, '2017-05-20', '2018-05-23', 2000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Milch', 1.15, '2017-12-17', '2018-01-19', 5000, 'ml' ,123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Zucker', 1.15, '2017-04-02','2018-03-14', 5000, 'g',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Margarine', 0.75, '2017-08-23','2018-04-23', 2000,'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Teabutter', 1.89, '2017-11-20', '2018-01-23', 2000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Banane', 1.99, '2017-12-28', '2018-01-20', 50, 'st',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Erdbeere', 3.99, '2017-12-28','2018-01-20', 2000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Eier', 2.75, '2017-11-18', '2018-01-23', 200,'st', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Nutella', 2.89, '2017-07-14', '2018-03-23', 2000, 'g',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Kochschokolade', 1.99, '2017-03-20','2018-05-13', 5000,'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Honig', 3.15, '2017-04-20','2018-11-23', 2000,'ml', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Mehl', 1.09, '2017-01-20', '2018-06-18', 10000, 'g',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Lebensmittelfarbstoffe', 2.45, '2017-03-20','2019-01-23',10, 'pg', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Topfen', 2.39, '2017-12-28', '2018-01-23', 1000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Löffelbiskuit', 1.55, '2017-09-30','2018-07-13',1000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Kakaopulver', 1.75, '2016-12-20', '2018-09-23', 1000, 'g', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Walnuss', 3.89, '2017-06-24', '2018-09-24',1200, 'g',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Kondensmilch', 1.09, '2017-09-20', '2018-09-23', 2000, 'ml',123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Sauerrahm', 0.99, '2017-12-20','2018-01-23', 10000, 'ml', 123)");
		stmt.executeUpdate("INSERT INTO produkt VALUES (" + artNr.getAndIncrement()
				+ ",'Dinkelmehl', 2.95,'2017-06-17', '2018-03-23',10000, 'g',123)");

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

		// ÄNDERN
		// EINKAUF
		try {

		/*	stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde1', 12341)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde2', 12342)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde3',12343)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde4', 12344)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde5', 12345)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde6', 12346)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde7', 12347)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde8', 12348)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde9', 12349)");
			stmt.executeUpdate("INSERT INTO einkauf VALUES ('Kunde10', 12350)");*/

		} catch (Exception e) {
			System.err.println("Fehler beim Einfuegen des Datensatzes: " + e.getMessage());
		}

		// check number of datasets in person table
		ResultSet re = stmt.executeQuery("SELECT COUNT(*) FROM einkauf");
		if (re.next()) {
			int count = re.getInt(1);
			System.out.println("Number of datasets 'Einkauf': " + count);
		}

		// ÄNDERN
		// BESTANDTEIL
		stmt.executeUpdate("INSERT INTO bestandteil VALUES (1000,78961,'Salz','Semmel', 7, 'g')");
		stmt.executeUpdate("INSERT INTO bestandteil VALUES (1000,78962,'Milch','Semmel', 250, 'ml')");		
		stmt.executeUpdate("INSERT INTO bestandteil VALUES (1001,78962,'Milch','Honigtorte', 300, 'ml')");		
		stmt.executeUpdate("INSERT INTO bestandteil VALUES (1002,78964,'Margarine','Apfelstrudel', 250, 'g')");		


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
		rd.close();
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
