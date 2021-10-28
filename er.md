# ER: Requirements Specification Component

> Project vision.

## A1: Project Name

> Goals, business context and environment.  
> Motivation.  
> Main features.  
> User profiles.

The main goal of toEaseManage is to create a web application to help with project development management. This is a tool that can be used by work teams in every project areas, by allowing the creation of a project, assigning teams and task and enabling discussion in the forum.
A project is formed by a project coordinator and a group of project members. The coordinator is responsible for inviting members to his project as well as assigning a new coordinator. Every team member is able to create, assign and complete tasks, as well as, to usufruit of the project discussion forum.

Users are only able to see the projects wich they are allocated to. On the other hand, the team of administrators can browse and view details of every project, however they can not create or participate in them.

toEaseManage will provide easy navigation and a great user experience to boost your projects results. 
  


---


## A2: Actors and User stories

> Brief presentation of the artefact goals.


### 1. Actors

> Diagram identifying actors and their relationships.  

![Actors Diagram](./Docs/ActorsDiagram.png)

> Table identifying actors, including a brief description.

| Identifier | Description |
| - | - |
| User | Generic user that has access to public information |
| Visitor | Unauthenticated user that can register itself (sign-up) or sign-in in the system |
| AuthUser | Authenticated user that can manage project invitation, create new projects as well as view them |
| Member | Authenticated user that is assigned to projects. Has access to all the project information, can manage tasks inside the project and is able to discuss in the forum
| Coordinator | Project member responsible for the project with permissions to choose other coordinator and deal with member’s permissions |
| PostAuthor | Project member that has already sent a message to the discussion forum and is now able to delete it or edit it |
| Admin | Authenticated user that is responsible for the management of the platform being able to browse projects and see their information |


### 2. User Stories

> User stories organized by actor.  
> For each actor, a table containing a line for each user story, and for each user story: an identifier, a name, a priority, and a description (following the recommended pattern).

#### 2.1. User

| Identifier | Name | Priority | Description |
| - | - | - | - |
| US01 | See Home | high | As a User, I want to access the home page, so that I can see a brief presentation of the website |
| US02 | See About | high | As a User, I want to access the about page, so that I can see a complete description of the website as well as its creators |
| US03 | Consult Contacts | medium | As a User, I want to access contacts, so that I can come in touch with the platform creators |
| US04 | Consult Services | medium | As a User, I want to access the services information, so that I can see the website’s services |

#### 2.2. Actor 2

#### 2.N. Actor n


### 3. Supplementary Requirements

> Section including business rules, technical requirements, and restrictions.  
> For each subsection, a table containing identifiers, names, and descriptions for each requirement.

#### 3.1. Business rules

#### 3.2. Technical requirements

#### 3.3. Restrictions


---


## A3: Information Architecture

> Brief presentation of the artefact goals.


### 1. Sitemap

> Sitemap presenting the overall structure of the web application.  
> Each page must be identified in the sitemap.  
> Multiple instances of the same page (e.g. student profile in SIGARRA) are presented as page stacks.


### 2. Wireframes

> Wireframes for, at least, two main pages of the web application.
> Do not include trivial use cases.


#### UIxx: Page Name

#### UIxx: Page Name


---


## Revision history

Changes made to the first submission:
1. Item 1
1. ...

***
GROUP21gg, DD/MM/2021

* Group member 1 name, email (Editor)
* Group member 2 name, email
* ...
