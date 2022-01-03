# EAP: Architecture Specification and Prototype

With the development of toEaseManage we intend to create a useful and acessible platform that helps users to organize projects as well as grow as web developers throughout the curricular unit. The website is for everyone, it can be used personally, for business, school, or even among friends.

## A7: High-level architecture. Privileges. Web resources specification

This artefact describes the architecture of the web application to be developed, indicating the catalogue of data, the properties of each one, and the format of JSON responses. This specification adheres to the OpenAPI standard using YAML.

This artefact presents the documentation for toEaseManage, including the CRUD (create, read, update, delete) operations for each data resource.

### 1. Overview

Here we identify the modules that are part of our application. It's division was made taking into account the granularity and meaning of each one of the modules. 

| Module | Description |
| ---- | ---- |
| __M01: Authentication and Individual Profile__ | Web features related to profile and managing a user's profile, such as login/logout and sign up actions, profile editing, password retrieval, and access to personal information. |
| __M02: Project__ | Web resources associated with project interaction. Includes the following system features: create and delete, view, edit, and search projects. |
| __M03: Tasks and Comments__ | Web features associated with project execution and details, as well as interaction with other project members. It includes the following system features: add/edit/comment tasks, plus you can edit or delete the comment made. |
| __M04: Project Forum and Labels__| Project Forum related web resources with the following system features: create, view, edit and delete forum messages.  It is also possible to create new labels to use inside a project, to characterize tasks with one or more, and besides that being able to remove the label as well as delete it from the project. |
| __M05: Invites and Notifications__ | Web resources associated to project invitations and notifications related to tasks, invitations and project modifications. It includes the following system features: create/list/accept/reject invitations and view/list notifications. |
| __M06: User Administration__ | Web features associated with user management, specifically: viewing, searching and blocking users accounts. Plus, in a user's administration you can view system access details for each user. |
| __M07: Static Pages__ | Web resources containning static content, such as information about the website and the developers of the website (about, contact, services). |

There is an explaination about the division that was made mainly in modules M02, M03, M04. 
Since projects and tasks are the main big services of our project, and even if a task exists only inside projects, there are a lot of methods to handle with the requests proposed. Therefore, we come to the conclusion that they should be separated. Soon we understood that task comments should be agrouped within the tasks modules, since they exist due to the existence of tasks (MO3). However, we remained with a very large module if we included the project forum and project labels inside the project module. As they belong to a project we decided to create other module that included the two of them (M04). Concluding the modules division with three modules more similar in size and more in context with what they are working with.  

### 2. Permissions

This section defines the permissions used in the modules to establish the conditions of access to resources.

| | | |
| --- | --- | --- |
| __PUB__ | Public | Visitors of the page. |
| __AUTH_USR__ | Authenticated User | User that has logged in. | User |
| __OWN__ | Owner | User that owns the information (e.g. forum messages, comments, profile). |
| __COOR__ | Coordinator | User that coordinates an instance (e.g. project coordinators). |
| __MEMB__ | Member | Relation of membership with a project. |
| __ADMIN__ | Administrator | Administrators of the system.  |

### 3. OpenAPI Specification

This section includes the complete API specification in OpenAPI (YAML).

Additionally [here](../Docs/a7_openapi.yaml) it is a link to the OpenAPI YAML file in the group's repository. 

Link to the Swagger generated documentation: https://app.swaggerhub.com/apis/toEase/a7_openapi/1.0.0-oas3. We did not had an account in Swagger sowe started free trial of the account, for only 15 days. We don't know if the link is going to still available after this day, so please contact us if there is something wrong.  

``` yaml
openapi: 3.0.0

...
```

---


## A8: Vertical prototype

This artefact has the necessary features implemented as well as other identified below. The vertical prototype abled us to get familiar with the tecnologies of the project and to build the main structure of our application. 

The LBAW Framework is behind the architecture of our prototype and all layers were build above it. Until now, we already worked in: user interface, business logic and data access. We also implemented features of creation, insertion, search, update, removel and deletion of information, the control of permissions and //////////////// presentation of error and sucess messages. 

### 1. Implemented Features

Inside this section we present the currently implemented web and system features. 

#### 1.1. Implemented User Stories

The user stories that are for now implemented in the prototype are described in the following table. 

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
| __US3.4__ | View Tasks | high | As a Member, I want to view all the tasks, so that I can see what everyone needed to do | FR.304 |
| __US3.6__ | Complete Tasks | high | As a Member, I want to be able to check the tasks I have done, so that everyone knows it is completed  | FR.306 |
| __US3.7__ | Search Tasks | high | As a Member, I want to be able to search tasks by keywords, so that I can easily find what I want | FR.312, FR.032 | 
| US3.8 | Leave Project | high | As a Member, I want to be able to leave a project , so that I stop being part of the that project team | FR.309 |
| US3.9 | View Project Details | high | As a Member, I want to be able to check project information, so that I can know the members of the project along with other relevant information  | FR.310 |
| US3.10 | View Team Profiles | high | As a Member, I want to be able to see other team members profiles , so that I can have more information about them| FR.311 |
| US3.13 | View Project Timeline | medium | As a Member, I want to be able to see project tasks done, so that I can have more understanding about the development of the project| FR.331 |
| US4.1 | Assign Coordinator | high | As a Coordinator, I want to be able to assign new coordinators to the project, so that I can have other Users helping me in the project management | FR.502 |
| US4.2 | Edit Project Details | high | As a Coordinator, I want to edit current project information, so that I can update information referent to the project| FR.503 |
| __US6.1__ | Login Admin Account | high | As an Admin, I want to be able to login in to my account, so that I can have an administrator profile| FR.041, FR.011 |
| __US6.2__ | Administer User | high | As an Admin, I want to search through the existing users, so that I can view, delete them | FR.042, FR.031 |
| __US6.5__ | Delete User | high | As a Admin, I want erase User accounts, so that they can not use their acount more. | FR.044 |
| __US6.6__ | Browse Projects | high | As an Admin, I want to be able to browse through projects, so that I can iterate through the existing projects | FR.701, FR.032 |
| __US6.7__ | View Project | high | As an Admin, I want view project details, so that I can validate the curret usage of the given features| FR.702 |

Some features and requirements, not previously noted as an user story we leave here in text:
1. (FR.501) Add user to project: for now this is possible, however not through the invite method, because the email feature is not yet implemented.
2. (FR.032) Full-text search: this is used in searching for projects or tasks, as well as for the Admin.
3. (FR.031) Exact match search: this is used in searching users to add them to projects, to assign them to tasks or as an Admin to simply search for them.


Some notes about using the application: 
1. To do some kind of search where there is a button search, it is all included in a form so it is necessary to click in the submit button. This happens in the user page to search for some specific filter or order mode. 
2. When you assign tasks when there is another user already assigned to it, another task is created assigned to the user you selected. It does not appear in the page of that task because it creates other that is only displayed in the project page. 
3. For now, due to the fact that invites are not yet implemented, when an user is added to a project you need to refresh the page in order to see it appear in the members section. 

#### 1.2. Implemented Web Resources

The web resources that were implemented in the prototype are presented in the next section.  

__Module M01: Authentication and Individual Profile__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R101: Login Form | GET | /login |
| R102: Login Action | POST | /login |
| R103: Logout Action | GET | /logout |
| R104: Register Form | GET | /register |
| R105: Register Action | POST | /register |
| R106: View User Page | GET | /users |
| R107: Delete User | DELETE | /users/{id} |
| R108: View User Profile | GET | /users/{id}/profile |
| R109: User Edit Profile Form | GET | /users/{id}/update |
| R110: Edit User Profile | POST | /users/{id}/update |
| R111: Recover Password Form | GET | /recoverPassword |
| R114: Search Users API | GET | /api/users |

__Module M02: Project__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R202: Project creation Form | GET | /projects |
| R203: Create Project | POST | /projects |
| R204: View project page | GET | /projects/{id} |
| R205: Delete project | POST | /projects/{id} |
| R206: View project details page | GET | /projects/{id}/details |
| R207: Project edit Form | GET | /projects/{id}/edit |
| R208: Edit project page | POST | /projects/{id}/edit |
| R209: Add coordinator | POST | /api/projects/addCoordinator |
| R210: Modify favourite project | POST | /api/projects/{id}/favourite |
| R211: Leave project | POST | /api/projects/{id}/leave |

__Module M03: Tasks and Comments__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R301: Search Tasks API | GET | /api/tasks |
| R302: Task creation Form | GET | /projects/{project_id}/tasks |
| R303: Create Task | POST | /tasks |
| R304: View task page | GET | /tasks/{id} |
| R305: Task edit Form | GET | /tasks/{id}/edit |
| R306: Edit task page | POST | /tasks/{id}/edit |
| R307: Complete task | POST | /tasks/{id}/complete |
| R308: Clone task | POST | /tasks/{id}/clone |

__Module M05: Invites and Notifications__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R501: Search Invites API | GET | /api/invites |

__Module M06: User Administration__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R601: Admin users page | GET | /admin |
| R602: Admin projects page | GET | /admin/projects |

__Module M07: User Administration__

| Web Resource Reference | Method    | URL                 |
| ---------------------- | --------- | ------------------- |
| R701: Home page | GET | / |
| R702: About page | GET | /about |
| R703: Contact page | GET | /contact |
| R704: Submit contact form | POST | /contact |
| R705: Service page | GET | /service |

### 2. Prototype

The prototype is available at: (link!!!!!!!!!!!!)

Credentials:
* Admin User: 
    * Email: admin@admin.com
    * Password: 123456
* Regular User: 
    * Email: 
    * Password: 

The code is available at: (link!!!!!!!!!!!!)

## Revision history

Changes made to the first submission:
1. - 

***
GROUP2102, 03/01/2021
 
* André Pereira, up201905650@up.pt
* Beatriz Lopes dos Santos, up201906888@up.pt
* Matilde Oliveira, up201906954@up.pt (editor)
* Ricardo Ferreira, up201907835@up.pt