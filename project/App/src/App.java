import java.sql.*;

public class App {

    public static void main(String[] args) {
        Connection conn = null;

        try {

            Class.forName("com.mysql.cj.jdbc.Driver");
            System.out.println("Driver load is successfull!!");
            String username = "selahattin.oztur";
            String password = "sFXKHkZQ";
            String dbName = "selahattin_ozturk";
            conn = DriverManager.getConnection("jdbc:mysql://dijkstra.ug.bcc.bilkent.edu.tr/" + dbName, username, password);
            System.out.println("You connect successfully!!");

        } catch (Exception e) {
            e.printStackTrace();
            System.out.println("You couldn't provide connection!!");
        }

        Statement stmt = null;
        String userTable = "CREATE TABLE User("+
            "u_id INT NOT NULL AUTO_INCREMENT, " +
            "email VARCHAR(32) NOT NULL, " +
            "name VARCHAR(32) NOT NULL, " +
            "password VARCHAR(32) NOT NULL, " +
            "role_id INT NOT NULL, " +
            "PRIMARY KEY(u_id)) ENGINE = INNODB;";

        String adminTable = "CREATE TABLE Admin(" +
            "u_id INT PRIMARY KEY," +
            "salary FLOAT, " +
            "FOREIGN KEY(u_id) REFERENCES User(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
    

        String employeeTable = "CREATE TABLE Employee (" +
            "u_id INT PRIMARY KEY, " +
            "nationality VARCHAR(32) NOT NULL, " +
            "FOREIGN KEY(u_id) REFERENCES User(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
        
        String studentTable = "CREATE TABLE Student (" +
            "u_id INT, " +
            "enrollment_date DATE NOT NULL, " +
            "PRIMARY KEY(u_id), " +
            "FOREIGN KEY(u_id) REFERENCES User(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String nativeTable = "CREATE TABLE Native (" +
            "u_id INT, " +
            "nationality VARCHAR(32) NOT NULL, " +
            "PRIMARY KEY(u_id), " +
            "FOREIGN KEY(u_id) REFERENCES User(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String teacherTable = "CREATE TABLE Teacher (" +
            "u_id INT PRIMARY KEY, " +
            "eligible_level VARCHAR(32) NOT NULL, " +
            "FOREIGN KEY(u_id) REFERENCES Employee(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String requestTable = "CREATE TABLE request_class (" +
            "t_id INT," +
            "s_id INT," +
            "level VARCHAR(32) NOT NULL," +
            "PRIMARY KEY(t_id,s_id)," +
            "FOREIGN KEY(t_id) REFERENCES Teacher(u_id) ON UPDATE CASCADE ON DELETE RESTRICT," +
            "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String homeworksTable = "CREATE TABLE Homeworks (" +
            "h_id CHAR(8), " +
            "description VARCHAR(32), " +
            "due_date VARCHAR(32) NOT NULL, "+
            "total_contribution INT NOT NULL, " +
            "PRIMARY KEY(h_id)) ENGINE=INNODB";
        
        String creates_hw_Table = "CREATE TABLE creates_hw (" +
            "h_id CHAR(8) NOT NULL," +
            "u_id INT NOT NULL," +
            "PRIMARY KEY(h_id)," +
            "FOREIGN KEY(h_id) REFERENCES Homeworks(h_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
    
        String assignTable = "CREATE TABLE assign (" +
            "t_id INT, " +
            "s_id INT, " +
            "h_id CHAR(8), " +
            "PRIMARY KEY( s_id, h_id), " +
            "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
            "FOREIGN KEY(h_id) REFERENCES Homeworks(h_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
    
        String gradesTable = "CREATE TABLE Grades (" +
            "t_id INT NOT NULL, " +
            "s_id INT NOT NULL, " +
            "h_id CHAR(8) NOT NULL, " +
            "grade INT NOT NULL, " +
            "PRIMARY KEY(s_id, h_id), " +
            "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
            "FOREIGN KEY(h_id) REFERENCES Homeworks(h_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
        
        String examTable = "CREATE TABLE Exam (" +
            "e_id CHAR(8), " +
            "date DATE NOT NULL, " +
            "PRIMARY KEY(e_id)) ENGINE=INNODB";

        String takesTable = "CREATE TABLE Takes (" +
            "e_id CHAR(8) NOT NULL, " +
            "s_id INT, " +
            "PRIMARY KEY(e_id, s_id), " +
            "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
            "FOREIGN KEY(e_id) REFERENCES Exam(e_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB ";

        String createsTable = "CREATE TABLE creates (" +
            "e_id CHAR(8) NOT NULL, " +
            "u_id INT NOT NULL, " +
            "PRIMARY KEY(e_id), " +
            "FOREIGN KEY(e_id) REFERENCES Exam(e_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

         String grades_exam_Table = "CREATE TABLE grades_exam( " +
            "s_id INT NOT NULL, " +
            "e_id CHAR(8) NOT NULL, " +
            "t_id INT NOT NULL, " +
            "grade INT NOT NULL, " +
            "PRIMARY KEY( s_id, e_id), " +
            "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
            "FOREIGN KEY(e_id) REFERENCES Exam(e_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String lessonTable = "CREATE TABLE lesson (" +
            "l_id CHAR(8), " +
            "l_name VARCHAR(32)  NOT NULL, " +
            "level VARCHAR(32) NOT NULL, " +
            "PRIMARY KEY(l_id)) ENGINE=INNODB";

        String giveTable = "CREATE TABLE give (" +
            "u_id INT NOT NULL, " +
            "l_id CHAR(8) NOT NULL, " +
            "PRIMARY KEY( l_id), " +
            "FOREIGN KEY(l_id) REFERENCES lesson(l_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String containsTable = "CREATE TABLE contains (" +
                "e_id CHAR(8) NOT NULL, " +
                "l_id CHAR(8) NOT NULL, " +
                "PRIMARY KEY(e_id, l_id), " +
                "FOREIGN KEY(e_id) REFERENCES Exam(e_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                "FOREIGN KEY(l_id) REFERENCES lesson(l_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
        
        String enrollsTable = "CREATE TABLE enrolls (" +
            "u_id INT NOT NULL, " +
            "l_id CHAR(8) NOT NULL, " +
            "status VARCHAR(32), " +
            "PRIMARY KEY(u_id, l_id), " +
            "FOREIGN KEY(u_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
            "FOREIGN KEY(l_id) REFERENCES lesson(l_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        
        String meetingTable = "CREATE TABLE Meeting (" +
            "m_id CHAR(8) NOT NULL, " +
            "date DATE  NOT NULL, " +
            "link VARCHAR(32)  NOT NULL, " +
            "PRIMARY KEY(m_id)) ENGINE=INNODB";

        String requestsTable = "CREATE TABLE requests (" +
                "m_id CHAR(8) NOT NULL, " +
                "s_id INT NOT NULL, " +
                "n_id INT NOT NULL, " +
                "PRIMARY KEY(m_id), " +
                "FOREIGN KEY(m_id) REFERENCES Meeting(m_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String holdsTable = "CREATE TABLE holds (" +
            "u_id INT, " +
            "m_id CHAR(8), " +
            "PRIMARY KEY(m_id), " +
            "FOREIGN KEY(m_id) REFERENCES Meeting(m_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String grades_meeting_Table = "CREATE TABLE grades_meeting (" +
                "u_id INT, " +
                "m_id CHAR(8), " +
                "grade FLOAT, " +
                "PRIMARY KEY( m_id), " +
                "FOREIGN KEY(m_id) REFERENCES Meeting(m_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String wordsTable = "CREATE TABLE Words (" +
                    "w_id CHAR(8) NOT NULL, " +
                    "word VARCHAR(32)  NOT NULL, " +
                    "definition VARCHAR(32)  NOT NULL, " +
                    "example_usage VARCHAR(32)  NOT NULL, " +
                    "PRIMARY KEY(w_id)) ENGINE=INNODB";

        String taught_in_Table = "CREATE TABLE taught_in (" +
                        "w_id CHAR(8) NOT NULL, " +
                        "l_id CHAR(8) NOT NULL, " +
                        "PRIMARY KEY(w_id, l_id), " +
                        "FOREIGN KEY(w_id) REFERENCES Words(w_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                        "FOREIGN KEY(l_id) REFERENCES lesson(l_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String definesTable = "CREATE TABLE defines (" +
                            "u_id INT NOT NULL," +
                            "w_id CHAR(8) NOT NULL, " +
                            "PRIMARY KEY( w_id), " +
                            "FOREIGN KEY(w_id) REFERENCES Words(w_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String creates_phrasal_Table = "CREATE TABLE creates_phrasal (" +
                            "pre_id CHAR(8) NOT NULL," +
                            "post_id INT NOT NULL," +
                            "new_meaning VARCHAR(32) NOT NULL," +
                            "PRIMARY KEY(pre_id)," +
                            "FOREIGN KEY(pre_id) REFERENCES Words(w_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String certificateTable = "CREATE TABLE Certificate (" +
            "certificate_id CHAR(8) NOT NULL," +
            "date DATE  NOT NULL, " +
            "definition VARCHAR(32)  NOT NULL," +
            "u_id INT NOT NULL, " +
            "PRIMARY KEY(certificate_id, date, definition, u_id), " +
            "FOREIGN KEY(u_id) REFERENCES Teacher(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String approvesTable = "CREATE TABLE approves(" +
                "u_id INT NOT NULL, " +
                "certificate_id CHAR(8) NOT NULL," +
                "date DATE NOT NULL, " +
                "definition VARCHAR(32) NOT NULL, " +
                "PRIMARY KEY(certificate_id, date, definition, u_id), " +
                "FOREIGN KEY(certificate_id, date, definition) REFERENCES Certificate(certificate_id, date, definition) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                "FOREIGN KEY(u_id) REFERENCES Teacher(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String activitiesTable = "CREATE TABLE Activities (" +
                    "a_id INT NOT NULL, " +
                    "date DATE  NOT NULL, " +
                    "description VARCHAR(32)  NOT NULL, " +
                    "s_id INT NOT NULL, " +
                    "PRIMARY KEY(a_id, date, description, s_id), " +
                    "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String viewTable = "CREATE TABLE view(" +
                       "t_id INT NOT NULL, " +
                        "a_id INT NOT NULL, " +
                        "date DATE NOT NULL, " +
                        "description VARCHAR(32) NOT NULL, " +
                        "s_id INT NOT NULL, " +
                        "PRIMARY KEY(a_id, date, description, s_id, t_id), " +
                        "FOREIGN KEY(a_id, date, description,s_id) REFERENCES Activities(a_id, date, description, s_id) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                        "FOREIGN KEY(t_id) REFERENCES Teacher(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String correspondsTable = "CREATE TABLE corresponds(" +
                            "lesson_id CHAR(8) NOT NULL, " +
                            "name CHAR(8) NOT NULL, " + 
                            "PRIMARY KEY(lesson_id), " +
                            "FOREIGN KEY(lesson_id) REFERENCES lesson(l_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB;";

        String languageTable = "CREATE TABLE language(" +
            "name  CHAR(8) NOT NULL, " +
            "PRIMARY KEY(name)) ENGINE=INNODB;";

        String learnsTable = "CREATE TABLE learns("  +
                "name CHAR(8) NOT NULL, " +
                "s_id INT NOT NULL, " +
                "level VARCHAR(32) NOT NULL, " +
                "PRIMARY KEY(name, s_id), " +
                "FOREIGN KEY(name) REFERENCES language(name) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                "FOREIGN KEY(s_id) REFERENCES Student(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";

        String knowsTable = "CREATE TABLE knows(" +
                    "name CHAR(8) NOT NULL, " +
                    "u_id INT NOT NULL, " +
                    "PRIMARY KEY(name, u_id), " +
                    "FOREIGN KEY(name) REFERENCES language(name) ON UPDATE CASCADE ON DELETE RESTRICT, " +
                    "FOREIGN KEY(u_id) REFERENCES Employee(u_id) ON UPDATE CASCADE ON DELETE RESTRICT) ENGINE=INNODB";
    
                    try {
                        stmt = conn.createStatement();
                        stmt.executeUpdate("SET FOREIGN_KEY_CHECKS = 0;");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Admin");
                        
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Student");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Native");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Teacher");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Employee");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS User");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS request_class");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Homeworks");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS creates_hw");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS assign");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Grades");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Exam");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Takes");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS creates");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS grades_exam");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS lesson");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS give");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS contains");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS enrolls");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Meeting");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS requests");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS holds");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS grades_meeting");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Words");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS taught_in");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS defines");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS creates_phrasal");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Certificate");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS approves");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS Activities");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS view");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS corresponds");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS language");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS learns");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("DROP TABLE IF EXISTS knows");
                        stmt = conn.createStatement();
                        stmt.executeUpdate("SET FOREIGN_KEY_CHECKS = 1;");
                    }catch (Exception e) {
                        System.out.println("ERROR! Tables are not created!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(userTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(employeeTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(teacherTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(nativeTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(studentTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(adminTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    

        
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(requestTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(homeworksTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(creates_hw_Table);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(assignTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(gradesTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(examTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(takesTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(createsTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(grades_exam_Table);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(lessonTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                        stmt = conn.createStatement();
                    stmt.executeUpdate(languageTable);
                    } catch (Exception e) {
                        System.out.println("Insertion cannot applied!");
                        e.printStackTrace();
                    }
                    try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(knowsTable);
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(learnsTable);
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(activitiesTable );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        } 
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(viewTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(certificateTable );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(approvesTable );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        } 
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(wordsTable );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(creates_phrasal_Table  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(definesTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(taught_in_Table );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(meetingTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(grades_meeting_Table );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(holdsTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(requestsTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                       
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(giveTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(enrollsTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(containsTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
                        try{
                            stmt = conn.createStatement();
                        stmt.executeUpdate(correspondsTable  );
                        } catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }

                        try{
                            stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO User VALUES('1', 'abc@gmail.com', 'basak', 'abc123', '1')");
                            stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO Student VALUES('1', '2022-05-17')");
                            stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO language VALUES('English')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO learns VALUES('English','1','C1')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO lesson VALUES('123', 'English', 'C1')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO enrolls VALUES('1', '123', 'Approved!')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO Homeworks VALUES('1', 'beginner', '17/05/2022', '5')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO Grades VALUES('1', '1', '1','100')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO Exam VALUES('1', '2022-05-17')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO grades_exam VALUES('1', '1', '1','100')");
                                stmt = conn.createStatement();
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO User VALUES('5', 'd@gmail.com', 'alper', 'alper123', '2')");
                                stmt.executeUpdate("INSERT INTO Employee VALUES('5', 'Turkish')");
                                stmt = conn.createStatement();
                                stmt.executeUpdate("INSERT INTO Teacher VALUES('5', '8')");
                        }catch (Exception e) {
                            System.out.println("Insertion cannot applied!");
                            e.printStackTrace();
                        }
    }

    

    private static void displayTheQuery(ResultSet resSet) throws SQLException {
        ResultSetMetaData metaData = resSet.getMetaData();
        System.out.println("Table: " + metaData.getTableName(1));
        int columncount = metaData.getColumnCount();
        for (int i = 0; i < columncount; i++) { 
            System.out.printf("%-15s", metaData.getColumnLabel(i + 1));
        }
        System.out.println();
        while (resSet.next()) {
            for (int i = 0; i < columncount; i++) { 
                System.out.printf("%-15s", resSet.getString(i + 1));
            }
            System.out.println(); 
        }
        System.out.println();
    }
}