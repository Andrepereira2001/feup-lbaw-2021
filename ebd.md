# EBD: Database Specification Component

With the development of toEaseManage we intend to create a useful and acessible platform that helps users to organize projects as well as grow as web developers throughout the curricular unit. 

## A4: Conceptual Data Model

> Brief presentation of the artefact goals.

### 1. Class diagram

![UML Diagram](./Docs/uml_diagram.png)
> UML class diagram containing the classes, associations, multiplicity and roles.  
> For each class, the attributes, associations and constraints are included in the class diagram.

### 2. Additional Business Rules
 
> Business rules can be included in the UML diagram as UML notes or in a table in this section.

A business rule defines actions the website may follow to function properly.

| Identifier | Name | Description |
| - | - | - | 
| BR01 | Account deletion | Upon account deletion, all the shared social data must be kept as anonymous author |
| BR04 | Leave project with task | Upon being removed from a project, all the tasks assignments not finished assigned to the member must be deleted |
| BR06 | User Block | Upon being blocked a User is removed from all his projects |
| BR08 | Member Comments | A project member can comment on its own assigned or created tasks |

---


## A5: Relational Schema, validation and schema refinement

> Brief presentation of the artefact goals.

### 1. Relational Schema

> The Relational Schema includes the relation schemas, attributes, domains, primary keys, foreign keys and other integrity rules: UNIQUE, DEFAULT, NOT NULL, CHECK.  
> Relation schemas are specified in the compact notation:  

| Relation reference | Relation Compact Notation                        |
| ------------------ | ------------------------------------------------ |
|R01 | User(<u>id</u>, email __UK NN__, password __NN__, name __NN__, image_path __NN DF__ img/default, blocked __NN DF__ false)             |
|R02 | Admin(<u>id</u>, email __UK NN__, password __NN__, name __NN__, image_path __NN DF__ img/default)                                     |
|R03 | Project(<u>id</u>, name __NN__, description, color, created_at __NN DF__ today, archived_at __CK__ archived_at > created_at)  |
|R04 | Participation(<u>id</u>, favourite __NN__, role __NN__ __CK__ role __IN__ Role, id_project → Project __NN__, id_user → User __NN__)                                                                                                                              |
|R05 | Task (<u>id</u>, name __NN__, description, priority __CK__ priority>=1 AND priority<=5, created_at __NN DF__ Today, finished_at __CK__ finished_at > created_at, id_project → Project __NN__, id_user → User)                                                 |
|R06 | Label(<u>id</u>, name __UK NN__)                                                                                              |
|R07 | TaskLabel(<u>id</u>, id_label → Label __NN__, id_task →Task __NN__) |
|R08 | TaskComment(<u>id</u>, content __NN__, created_at __NN DF__ Today, id_task →Task __NN__, id_user → User)                      |
|R09 | ForumMessage(<u>id</u>, content __NN__, created_at __NN DF__ Today, id_project → Project __NN__, id_user → User)              |
|R010| Invite(<u>id</u>, created_at __NN DF__ Today, id_user → User __NN__, id_project → Project __NN__)                             |
|R011| Notification(<u>id</u>, content __NN__, created_at __NN DF__ Today, id_project → Project __NN__)                              |
|R012| Seen(<u>id</u>, id_user → User __NN__, id_notification → Notification __NN__, seen __NN DF__ FALSE)                           |

nota: uid e nid são uk em conjunto

Legend:
* UK = UNIQUE KEY
* NN = NOT NULL
* DF = DEFAULT
* CK = CHECK
 
### 2. Domains

> The specification of additional domains can also be made in a compact form, using the notation:  

| Domain Name | Domain Specification           |
| ----------- | ------------------------------ |
| Today	      | DATE DEFAULT CURRENT_DATE      |
| Role        | ENUM ('Member', 'Coordinator') |

### 3. Schema validation

> To validate the Relational Schema obtained from the Conceptual Model, all functional dependencies are identified and the normalization of all relation schemas is accomplished. Should it be necessary, in case the scheme is not in the Boyce–Codd Normal Form (BCNF), the relational schema is refined using normalization.  


| **TABLE R01**   | User               |
| --------------  | ---                |
| **Keys**        | { id }, { email }  |
| **Functional Dependencies:** |       |
| FD0101          | { id } → {email, password, name, image_path, blocked} |
| FD0102          | { email } → {id, password, name, image_path, blocked} |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 

| **TABLE R02**   | Admin               |
| --------------  | ---                |
| **Keys**        | { id }, { email }  |
| **Functional Dependencies:** |       |
| FD0101          | { id } → {email, password, name, image_path} |
| FD0102          | { email } → {id, password, name, image_path} |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 


| **TABLE R03**   | Project               |
| --------------  | ---                |
| **Keys**        | { id }             |
| **Functional Dependencies:** |       |
| FD0101          | { id } → {name, description, color, created_at, archived_at} |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 


| **TABLE R04**   | Participation               |
| --------------  | ---                |
| **Keys**        | { id } , { id_project, id_user }            |
| **Functional Dependencies:** |       |
| FD0101          | { id } → {favourite, role, id_project, id_user} |
| FD0102          | { id_project, id_user } → {id, favourite, role } |
| **NORMAL FORM** | BCNF    

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF.            |


| **TABLE R05**   | Task               |
| --------------  | ---                |
| **Keys**        | { id }             |
| **Functional Dependencies:** |       |
| FD0501          | { id } → {name, description, priority, created_at, finished_at, id_project, id_user} |
| **NORMAL FORM** | BCNF               |

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 


| **TABLE R06**   | Label               |
| --------------  | ---                |
| **Keys**        | { id } {name} |
| **Functional Dependencies:** |       |
| FD0601          | { id } → {name} |
| FD0601          | { name } → {id} |
| **NORMAL FORM** | BCNF   

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 

| **TABLE R07**   | TaskLabel |
| --------------  | ---                |
| **Keys**        | { id }, { id_label, id_task }|
| **Functional Dependencies:** |       |
| FD0601          | { id } → {id_lable, id_task} |
| FD0601          | { id_lable, id_task } → {id} |
| **NORMAL FORM** | BCNF   

> If necessary, description of the changes necessary to convert the schema to BCNF.  
> Justification of the BCNF. 

| **TABLE R08**   | TaskComment |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0601          | { id } → {content , created_at, id_task, id_user } |
| **NORMAL FORM** | BCNF  


| **TABLE R09**   | ForumMessage    |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0601          | { id } → { content, created_at, id_project, id_user} |
| **NORMAL FORM** | BCNF |  

| **TABLE R10**   | Invite               |
| --------------  | ---                |
| **Keys**        | { id } , {id_project, id_user}|
| **Functional Dependencies:** |
| FD0601          | { id } → { created_at, id_project, id_user} |
| FD0601          | {id_project, id_user} → { id, created_at} |
| **NORMAL FORM** | BCNF 

| **TABLE R11**   | Notification       |
| --------------  | ---                |
| **Keys**        | { id } |
| **Functional Dependencies:** |       |
| FD0601          | { id } → { content, created_at, id_project} |
| **NORMAL FORM** | BCNF |  


| **TABLE R12**   | Seen  |
| --------------  | ---                |
| **Keys**        | { id } , { id_user, id_notification} |
| **Functional Dependencies:** |       |
| FD1201          | { id } → { id_user, id_notification, seen} |
| FD1202          | { id_user, id_notification } → {id, seen}  |  
| **NORMAL FORM** | BCNF |  
---


## A6: Indexes, triggers, transactions and database population

> Brief presentation of the artefact goals.

### 1. Database Workload
 
> A study of the predicted system load (database load).
> Estimate of tuples at each relation.

| **Relation reference** | **Relation Name** | **Order of magnitude**        | **Estimated growth** |
| ------------------ | ------------- | ------------------------- | -------- |
| R01                | Table1        | units|dozens|hundreds|etc | order per time |
| R02                | Table2        | units|dozens|hundreds|etc | dozens per month |
| R03                | Table3        | units|dozens|hundreds|etc | hundreds per day |
| R04                | Table4        | units|dozens|hundreds|etc | no growth |


### 2. Proposed Indices

#### 2.1. Performance Indices
 
> Indices proposed to improve performance of the identified queries.

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Cardinality**     | Attribute cardinality: low/medium/high |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||

> Analysis of the impact of the performance indices on specific queries.
> Include the execution plan before and after the use of indices.

| **Query**       | SELECT01                               |
| ---             | ---                                    |
| **Description** | One sentence describing the query goal |
| `SQL code`                                              ||
| **Execution Plan without indices**                      ||
| `Execution plan`                                        ||
| **Execution Plan with indices**                         ||
| `Execution plan`                                        ||


#### 2.2. Full-text Search Indices 

> The system being developed must provide full-text search features supported by PostgreSQL. Thus, it is necessary to specify the fields where full-text search will be available and the associated setup, namely all necessary configurations, indexes definitions and other relevant details.  

| **Index**           | IDX01                                  |
| ---                 | ---                                    |
| **Relation**        | Relation where the index is applied    |
| **Attribute**       | Attribute where the index is applied   |
| **Type**            | B-tree, Hash, GiST or GIN              |
| **Clustering**      | Clustering of the index                |
| **Justification**   | Justification for the proposed index   |
| `SQL code`                                                  ||


### 3. Triggers
 
> User-defined functions and trigger procedures that add control structures to the SQL language or perform complex computations, are identified and described to be trusted by the database server. Every kind of function (SQL functions, Stored procedures, Trigger procedures) can take base types, composite types, or combinations of these as arguments (parameters). In addition, every kind of function can return a base type or a composite type. Functions can also be defined to return sets of base or composite values.  

| **Trigger**      | TRIGGER01                              |
| ---              | ---                                    |
| **Description**  | Trigger description, including reference to the business rules involved |
| `SQL code`                                             ||

### 4. Transactions
 
> Transactions needed to assure the integrity of the data.  

| SQL Reference   | Transaction Name                    |
| --------------- | ----------------------------------- |
| Justification   | Justification for the transaction.  |
| Isolation level | Isolation level of the transaction. |
| `Complete SQL Code`                                   ||


## Annex A. SQL Code

> The database scripts are included in this annex to the EBD component.
> 
> The database creation script and the population script should be presented as separate elements.
> The creation script includes the code necessary to build (and rebuild) the database.
> The population script includes an amount of tuples suitable for testing and with plausible values for the fields of the database.
>
> This code should also be included in the group's git repository and links added here.

### A.1. Database schema

### A.2. Database population


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ..

***
GROUP21gg, DD/MM/2021
 
* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...
