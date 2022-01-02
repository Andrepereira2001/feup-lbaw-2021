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
| __M06: User Administration__ | Web features associated with user management, specifically: viewing, searching and blocking users accounts. Plus, in a user's administration you can view system access details for each user. |
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
| __ADMIN__ | Administrator | Administrators of the system.  |

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

| User Story reference | Name                   | Priority                   | Description                   | Functional Requirements |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- | ----------------------- |
| US0.1 | See Home | high | As a User, I want to access the home page, so that I can see a brief presentation of the website | NA |
| US0.2 | See About | high | As a User, I want to access the about page, so that I can see a complete description of the website as well as its creators | FR.061 |
| US0.3 | Consult Contacts | medium | As a User, I want to access contacts, so that I can come in touch with the platform creators | FR.063 |
| US0.4 | Consult Services | medium | As a User, I want to access the services information, so that I can see the website’s services | FR.062 |
| __US1.1__ | Sign-in | high | As a Visitor, I want to authenticate into the system, so that I can access privileged information | FR.011 |
| __US1.2__ | Sign-up | high | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system |FR.012 |
| __US2.1__ | Create projects | high | As a AuthUser, I want to create my own projects, so that the users can work on the project | FR.201 |
| __US2.2__ | View projects | high | As a AuthUser, I want to view the projects that are allocated to me, so that I can work on them | FR.202 |
| __US2.3__ | Mark project as favorite | high | As a AuthUser, I want to mark the projects as favorite, so that I can easily find the projects that interests me the most | FR.204 |
| __US2.4__ | Logout | high | As a AuthUser, I want to log out of my account, so that I can leave the website safely  | FR.011 |
| US2.5 | Delete account | high | As a AuthUser, I want to be able to delete my account, so that I can remove my information from the website | FR.014 |
| __US2.6__ | View profile | high | As a AuthUser, I want to view my profile information, so that I can check it  | FR.021 |
| __US2.7__ | Edit profile | high | As a AuthUser, I want to edit my profile information, so that I can update it | FR.022 |
| US2.14 | Order Project | low | As a AuthUser, I want to be able to go through my project in an order of my choice (alphabetical, cronological), so that I can find it easily | FR.035 |
| __US3.1__ | Create Tasks | high | As a Member, I want to create tasks, so that I can add to dos to the project  | FR.301 |
| __US3.2__ | Manage Tasks | high | As a Member, I want to manage tasks details, so that I can change task information such as due date and priority | FR.302 |
| US3.3 | Assign Tasks | high | As a Member, I want to assign tasks to members of the project, so that everyone knows what to do | FR.303 |
| __US3.4__ | View Tasks | high | As a Member, I want to view all the tasks, so that I can see what everyone needed to do |
| US3.5 | Comment Tasks | high | As a Member, I want to comment on tasks, so that I can complete it with additional information |
| __US3.6__ | Complete Tasks | high | As a Member, I want to be able to check the tasks I have done, so that everyone knows it is completed  |
| __US3.7__ | Search Tasks | high | As a Member, I want to be able to search tasks by keywords, so that I can easily find what I want|
| US3.8 | Leave Project | high | As a Member, I want to be able to leave a project , so that I stop being part of the that project team |
| US3.9 | View Project Details | high | As a Member, I want to be able to check project information, so that I can know the members of the project along with other relevant information  |
| US3.10 | View Team Profiles | high | As a Member, I want to be able to see other team members profiles , so that I can have more information about them|
| US3.13 | View Project Timeline | medium | As a Member, I want to be able to see project tasks done, so that I can have more understanding about the development of the project|
| US4.1 | Assign Coordinator | high | As a Coordinator, I want to be able to assign new coordinators to the project, so that I can have other Users helping me in the project management |
| US4.2 | Edit Project Details | high | As a Coordinator, I want to edit current project information, so that I can update information referent to the project|
| __US6.1__ | Login Admin Account | high | As an Admin, I want to be able to login in to my account, so that I can have an administrator profile|
| __US6.2__ | Administer User | high | As an Admin, I want to search through the existing users, so that I can view, delete them|
| __US6.5__ | Delete User | high | As a Admin, I want erase User accounts, so that they can not use their acount more. |
| __US6.6__ | Browse Projects | high | As an Admin, I want to be able to browse through projects, so that I can iterate through the existing projects |
| __US6.7__ | View Project | high | As an Admin, I want view project details, so that I can validate the curret usage of the given features|


Note: atualmente conseguimos adicionar um membro ao projeto mas ainda não esta implementado com recurso aos invites. 
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
1. - 

***
GROUP2102, 03/01/2021
 
* André Pereira, up201905650@up.pt
* Beatriz Lopes dos Santos, up201906888@up.pt
* Matilde Oliveira, up201906954@up.pt
* Ricardo Ferreira, up201907835@up.pt