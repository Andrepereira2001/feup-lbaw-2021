# EAP: Architecture Specification and Prototype

> Project vision.

## A7: High-level architecture. Privileges. Web resources specification

> Brief presentation of the artefact's goals.

### 1. Overview

> Identify and overview the modules that will be part of the application.  

| | |
| ---- | ---- |
| __M01: Authentication and Individual Profile__ | Features related to profile and managing a user's profile, such as login/logout and sign up actions, profile editing, password retrieval, and access to personal information.

 Web resources associated with user authentication and individual profile management. Includes the following system features: login/logout, registration, credential recovery, view and edit personal profile information |
| __M02: Project and Forum__ | Web resources associated with :::: . Includes the following system features: projects list and search, view and edit project details, and delete projects |
| __M03: Tasks, Comments and Labels__ |  |
| __M04: Invites and Notifications__ |  |
| __M05: User Administration and Static Pages__ |  |

### 2. Permissions

> Define the permissions used by each module, necessary to access its data and features.  

| | | |
| --- | --- | --- |
| __PUB__ | Public | Visitors of the page |
| __AUTH_USR__ | Authenticated User | User that have passed the login | User |
| __OWN__ | Owner | User that owns the information |
| __ADM__ | Administrator |  |

### 3. OpenAPI Specification

OpenAPI specification in YAML format to describe the web application's web resources.

Link to the `.yaml` file in the group's repository.

Link to the Swagger generated documentation (e.g. `https://app.swaggerhub.com/apis-docs/...`).

```yaml
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
