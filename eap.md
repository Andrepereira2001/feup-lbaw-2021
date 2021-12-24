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

| User Story reference | Name                   | Priority                   | Description                   |
| -------------------- | ---------------------- | -------------------------- | ----------------------------- |
| US01                 | Name of the user story | Priority of the user story | Description of the user story |

#### 2.0. User

| Identifier | Name | Priority | Description |
| - | - | - | - |
| US0.1 | See Home | high | As a User, I want to access the home page, so that I can see a brief presentation of the website |
| US0.2 | See About | high | As a User, I want to access the about page, so that I can see a complete description of the website as well as its creators |
| US0.3 | Consult Contacts | medium | As a User, I want to access contacts, so that I can come in touch with the platform creators |
| US0.4 | Consult Services | medium | As a User, I want to access the services information, so that I can see the website’s services |
> Table 2: User User Stories


#### 2.1. Visitor

| Identifier | Name | Priority | Description |
| - | - | - | - |
| __US1.1 ??__ | Sign-in | high | As a Visitor, I want to authenticate into the system, so that I can access privileged information |
| __US1.2 ??__ | Sign-up | high | As a Visitor, I want to register myself into the system, so that I can authenticate myself into the system |

> Table 3: Visitor User Stories

#### 2.2. AuthUser

| Identifier | Name | Priority | Description |
| - | - | - | - |
| __US2.1??__ | Create projects | high | As a AuthUser, I want to create my own projects, so that the users can work on the project |
| __US2.2!!__ | View projects | high | As a AuthUser, I want to view the projects that are allocated to me, so that I can work on them |
| __US2.3 !!__ | Mark project as favorite | high | As a AuthUser, I want to mark the projects as favorite, so that I can easily find the projects that interests me the most |
| __US2.4 ??__ | Logout | high | As a AuthUser, I want to log out of my account, so that I can leave the website safely  |
| US2.5 | Delete account | high | As a AuthUser, I want to be able to delete my account, so that I can remove my information from the website |
| __US2.6 ??__ | View profile | high | As a AuthUser, I want to view my profile information, so that I can check it  |
| __US2.7 ??__ | Edit profile | high | As a AuthUser, I want to edit my profile information, so that I can update it |
| US2.8 | Upload Profile Pictures | high | As a AuthUser, I want to upload a profile picture for me account, so that users can identify me |
| US2.9 | View notifications | high | As a AuthUser, I want to be able to see the notifications, so that informs me of some changes |
| US2.10 | Appeal for unblock | high | As a AuthUser, I want to be able to ask for the Administrators to unblock my account, so that I can continue with my work  |
| US2.11 | Receive Notifications | high | As a AuthUser, I want to receive notifications relevant to me, so that I can be aware of what is appening |
| US2.12 | Accept project invitations | high | As a AuthUser, I want to be able to accept project invitations, so that i can be part of them | 
| US2.13 | Project Invitation | low | As a AuthUser, I want to manage my project invitations, so that I can accept or refuse the invites |
| US2.14 | Order Project | low | As a AuthUser, I want to be able to go through my project in an order of my choice (alphabetical, cronological), so that I can find it easily |
> Table 4: AuthUser User Stories

#### 2.3. Member

| Identifier | Name | Priority | Description |
| - | - | - | - |
| __US3.1??__ | Create Tasks | high | As a Member, I want to create tasks, so that I can add to dos to the project  |
| __US3.2??__ | Manage Tasks | high | As a Member, I want to manage tasks details, so that I can change task information such as due date |
| US3.3 | Assign Tasks | high | As a Member, I want to assign tasks to members of the project, so that everyone knows what to do |
| __US3.4??__ | View Tasks | high | As a Member, I want to view all the tasks, so that I can see what everyone needed to do |
| US3.5 | Comment Tasks | high | As a Member, I want to comment on tasks, so that I can complete it with additional information |
| __US3.6??__ | Complete Tasks | high | As a Member, I want to be able to check the tasks I have done, so that everyone knows it is completed  |
| __US3.7??__ | Search Tasks | high | As a Member, I want to be able to search tasks by keywords, so that I can easily find what I want|
| US3.8 | Leave Project | high | As a Member, I want to be able to leave a project , so that I stop being part of the that project team |
| US3.9 | View Project Details | high | As a Member, I want to be able to check project information, so that I can know the members of the project along with other relevant information  |
| US3.10 | View Team Profiles | high | As a Member, I want to be able to see other team members profiles , so that I can have more information about them|
| US3.11 | Browse the Project Forum | medium | As a Member, I want to be able to navigate in the project forum so that I can be part of current discussions |
| US3.12 | Post messages to Project Forum | medium | As a Member, I want to be able to publish messages, so that I can participate in any forum discussion |
| US3.13 | View Project Timeline | medium | As a Member, I want to be able to see project tasks done, so that I can have more understanding about the development of the project|
> Table 5: Member User Stories

#### 2.4. Coordinator

| Identifier | Name | Priority | Description |
| - | - | - | - |
| US4.1 | Assign Coordinator | high | As a Coordinator, I want to be able to assign new coordinators to the project, so that I can have other Users helping me in the project management |
| US4.2 | Edit Project Details | high | As a Coordinator, I want to edit current project information, so that I can update information referent to the project|
| US4.3 | Remove Member | high | As a Coordinator, I want to be able to remove some member from the project , so that I can decide wich persons are working in the project |
| US4.4 | Archive Project | high | As a Coordinator, I want store all data relative to the project, so that I can safely record finished projects|
| __US4.5??__ | Invite Users | low | As a Coordinator, I want to invite other persons to my project by email , so that I can have more members in my project|
| US4.6 | Manage Members Permissions | low | As a Coordinator, I want manage project Members permissions, so that I can control what members can manage|
> Table 6: Coordinator User Stories

#### 2.5. PostAuthor

| Identifier | Name | Priority | Description |
| - | - | - | - |
| US5.1 | Edit Post | low | As a PostAuthor, I want to edit the post that I had made , so that I can rectify what I had wrote before|
| US5.2 | Delete Post | low | As a PostAuthor, I want to delete post that I had made , so that I can erase some mistaken post |
> Table 7: PostAuthor User Stories

#### 2.6. Admin

| Identifier | Name | Priority | Description |
| - | - | - | - |
| __US6.1??__ | Login Admin Account | high | As an Admin, I want to be able to login in to my account, so that I can have an administrator profile|
| __US6.2??__ | Administer User | high | As an Admin, I want to search through the existing users, so that I can view, edit and create them|
| __US6.3??__ | Block User | high | As an Admin, I want to be able to block some User account, so that I can prevent them from using the website wrongly|
| US6.4 | Unblock User | high | As an Admin, I want to unblock Users, so that I can give their permissions back|
| __US6.5??__ | Delete User | high | As a Admin, I want erase User accounts, so that I can remove there working history from the website|
| __US6.6??__ | Browse Projects | high | As an Admin, I want to be able to browse through projects, so that I can iterate through the existing projects |
| __US6.7??__ | View Project | high | As an Admin, I want view project details, so that I can validate the curret usage of the given features|
> Table 8: Admin User Stories

#### 2.7. OAuth API
| Identifier | Name | Priority | Description |
| - | - | - | - |
| US7.1 | Get Information | high | As a OAuth API, I want to get information related to the User, so that all the information is updated |
> Table 9: OAuth API User Stories

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
