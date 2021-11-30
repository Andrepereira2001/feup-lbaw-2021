# EAP: Architecture Specification and Prototype

> Project vision.

## A7: High-level architecture. Privileges. Web resources specification

> Brief presentation of the artefact's goals.

### 1. Overview

> Identify and overview the modules that will be part of the application.  

| | |
| ---- | ---- |
| __M01: Authentication and Individual Profile__ | Web features related to profile and managing a user's profile, such as login/logout and sign up actions, profile editing, password retrieval, and access to personal information. |
| __M02: Project__ | Web resources associated with project interaction. Includes the following system features: create and delete, view, edit, and search projects. |
| __M03: Tasks, Comments and Labels__ | Web features associated with project execution and details, as well as interaction with other project members. It includes the following system features: add/edit/comment tasks, plus you can edit or delete the comment made. It is also possible to characterize a task with one or more lables, creating them or using already existing lables in the project besides being able to remove the lable as well as delete it from the project.|
| __M04: Forum__| Forum related web resources with the following system features: create, view, edit and delete forum messages. |
| __M05: Invites and Notifications__ | Web resources associated to project invitations and notifications related to tasks, invitations and project modifications. It includes the following system features: create/list/accept/reject invitations and view/list notifications. |
| __M06: User Administration__ | Web features associated with user management, specifically: viewing, searching, blocking, and editing account information for all users. Plus, in a user's administration you can view system access details for each user. |
| __M07: Static Pages__ | Web resources containning static content, such as information about the website and the developers of the website (about, contact, services). |

> justificar o porque do m04 está separado do m02

### 2. Permissions

> Define the permissions used by each module, necessary to access its data and features.  

| | | |
| --- | --- | --- |
| __PUB__ | Public | Visitors of the page. |
| __AUTH_USR__ | Authenticated User | User that has logged in. | User |
| __OWN__ | Owner | User that owns the information (e.g. forum messages, comments, profile). |
| __COOR__ | Coordinator | User that coordinates an instance (e.g. project coordinators). |
| __MEMB__ | Member | Relation of membership with a project. |
| __ADM__ | Administrator | Administrators of the system.  |

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `.yaml` file in the group's repository.

Link to the Swagger generated documentation (e.g. `https://app.swaggerhub.com/apis-docs/...`).

``` yaml
openapi: 3.0.0

...
```

---


## A8: Vertical prototype

> Brief presentation of the artefact goals.

### 1. Implemented Features

#### 1.1. Implemented User Stories

> Identify the user stories that were implemented in the prototype.  

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01                 | Name of the user story | Priority of the user story | Description of the user story |

...

#### 1.2. Implemented Web Resources

> Identify the web resources that were implemented in the prototype.  

> Module M01: Module Name  

| Web Resource Reference | URL                            |
| ---------------------- | ------------------------------ |
| R01: Web resource name | URL to access the web resource |

...

> Module M02: Module Name  

...

### 2. Prototype

> URL of the prototype plus user credentials necessary to test all features.  
> Link to the prototype source code in the group's git repository.  


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
