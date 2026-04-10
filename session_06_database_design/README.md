# Database Design Exercises

## Part 1: Normalization

| Table Name  | Primary Key           | Foreign Key         | Normal Form | Description |
| :---------- | :-------------------- | :------------------ | :---------- | :---------- |
| Students    | StudentID             | None                | 3NF         | Stores student information |
| Professors  | ProfessorID           | None                | 3NF         | Stores professor information including email |
| Courses     | CourseID              | ProfessorID         | 3NF         | Stores course information and links to professors |
| Enrollments | (StudentID, CourseID) | StudentID, CourseID | 3NF         | Stores which student takes which course and their grade |

---

## Part 2: Relationships

- **Author to Book:** One-to-Many (1:N). One author can write many books, so the foreign key is stored in the Books table.

- **Citizen to Passport:** One-to-One (1:1). Each citizen has one passport, so the foreign key can be stored in the Passports table.

- **Customer to Order:** One-to-Many (1:N). One customer can place multiple orders, so CustomerID is stored in the Orders table.

- **Student to Class:** Many-to-Many (M:N). A student can take multiple classes and a class can have many students. This requires a junction table such as Enrollments.

- **Team to Player:** One-to-Many (1:N). One team has many players, so the foreign key TeamID is stored in the Players table.
