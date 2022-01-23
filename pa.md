# PA: Product and Presentation

With the development of toEaseManage we intend to create a useful and acessible platform that helps users to organize projects as well as grow as web developers throughout the curricular unit. The website is for everyone, it can be used personally, for business, school, or even among friends.

## A9: Product

This artefact has the final version of product developed. All features implemented are identified below as well as the main usage, administration credentials and application help. 

### 1. Installation

> Link to the release with the final version of the source code in the group's git repository.  

In order to test our docker image locally the following comand must be executed: 
```
docker run -it -p 8000:80 --name=lbaw2102 -e DB_DATABASE="lbaw2102" -e DB_SCHEMA="lbaw2102" -e DB_USERNAME="lbaw2102" -e DB_PASSWORD="LqprwisN" git.fe.up.pt:5050/lbaw/lbaw2122/lbaw2102
```

### 2. Usage

URL to the product: http://lbaw2102.lbaw.fe.up.pt  

#### 2.1. Administration Credentials

Administration URL: http://lbaw2102.lbaw.fe.up.pt

| Email | Password |
| ----- | -------- |
| admin@admin.com | 123456 |

#### 2.2. User Credentials

| Type          | Email  | Password |
| ------------- | --------- | -------- |
| Coordinator/Member | sbennallck2@is.gd | 123456 |
| Member | mferries0@yellowpages.com | 123456 |

### 3. Application Help

Contextual help was implemented in our project with the addition of small question marks that can be hovered to give extra information about a certain button action. 
![Archive exemple](../Docs/contextual-help1.png)

Aditionaly error messages are presented to the user if some invalid action is made.
![Invalid task creation](../Docs/error-messages.png)

### 4. Input Validation

> Describe how input data was validated, and provide examples to scenarios using both client-side and server-side validation.

In our project we use both client-side and server-side validation for example while receiving date inputs from the user:

In our blade.php we have created a date type input:

![html validation](../Docs/dateValidationHTML.png)

In the controller we are verifing the existance of a data attribute: 

![php validation](../Docs/dateValidationPHP.png)

In our database we check if the given date is valid in that context: 

![postgres validation](../Docs/dateValidationSQL.png)

### 5. Check Accessibility and Usability

The usability and accessibility tests were done following the checklists provided below. Plase check the two links in case of doubts. 

Accessibility: [link to the checklist](../Docs/acessibilidade-sapo.pdf)

Usability: [link to the checklist](../Docs/usabilidade-sapo.pdf)

### 6. HTML & CSS Validation

> Provide the results of the validation of the HTML and CSS code using the following tools. Include the results as PDF files in the group's repository. Add individual links to those files here.
>   
> HTML: https://validator.w3.org/nu/  
> CSS: [link to the css validation](../Docs/toEaseManageCss-sapo.pdf)  

### 7. Revisions to the Project

The final product abled us to finally be aware of some user stories that we did not explicitate in the first documents.
In ER we added user stories related to labels and other concerning the reset password feature. 
In EAP the yaml document was review and edited to be in agreement with the requests and routes that we effectivelly implemented having corrected some requests, deleted others that were not implemented as we expected. 

### 8. Implementation Details

#### 8.1. Libraries Used

> Include reference to all the libraries and frameworks used in the product.  
> Include library name and reference, description of the use, and link to the example where it's used in the product.  

In our project we use [Bootstrap](https://getbootstrap.com/), to implement our popups. The usage of this library can be seen here:

#### 8.2 User Stories

> This subsection should include all high and medium priority user stories, sorted by order of implementation. Implementation should be sequential according to the order identified below. 
>
> If there are new user stories, also include them in this table. 
> The owner of the user story should have the name in **bold**.
> This table should be updated when a user story is completed and another one started. 

| US Identifier | Name    | Module | Priority                       | Team Members               | State  |
| - | - | - | - | - | - |
| US1.1 | Sign-in | M01: Authentication and Individual Profile | high | __Beatriz Santos__ | 100% |
| US1.2 | Sign-up | M01: Authentication and Individual Profile | high | __Beatriz Santos__ | 100% |
| US2.2 | View projects | M02: Project | high | __André Pereira__, Beatriz Santos, Matilde Oliveira | 100% |
| US2.4 | Logout | M01: Authentication and Individual Profile | high | __Beatriz Santos__ | 100% |
| US2.6 | View profile | M01: Authentication and Individual Profile | high | __Beatriz Santos__ | 100% |
| US6.7 | View Project | M02: Project | high | __Matilde Oliveira__ | 100% |
| US3.9 | View Project Details | M02: Project | high | __André Pereira__ | 100% |
| US3.4 | View Tasks | M03: Tasks and Comments | high | __Matilde Oliveira__ | 100% |
| US3.13 | View Project Timeline | M02: Project | medium | __Matilde Oliveira__ | 100% |
| US2.7 | Edit profile | M01: Authentication and Individual Profile | high | __Beatriz Santos__ | 100% |
| US2.3 | Mark project as favorite | M02: Project | high | __André Pereira__ | 100% |
| US2.1 | Create projects | M02: Project | high | __André Pereira__,Matilde Oliveira | 100% |
| US3.1 | Create Tasks | M03: Tasks and Comments | high | __Matilde Oliveira__ | 100% |
| US3.2 | Manage Tasks | M03: Tasks and Comments | high | __Matilde Oliveira__ | 100% |
| US3.7 | Search Tasks | M03: Tasks and Comments | high | __André Pereira__ | 100% |
| US3.10 | View Team Profiles | M02: Project | high | __André Pereira__, Matilde Oliveira | 100% |
| US4.2 | Edit Project Details | M02: Project | high | __André Pereira__, Beatriz Santos, Matilde Oliveira | 100% |
| US2.14 | Order Projects | M02: Project | low | __André Pereira__ | 100% |
| US3.6 | Complete Tasks | M03: Tasks and Comments | high | __Matilde Oliveira__ | 100% |
| US2.5 | Delete account | M01: Authentication and Individual Profile | high | __Beatriz Santos__, André Pereira | 100% |
| US3.8 | Leave Project | M02: Project | high | __André Pereira__ | 100% |
| US4.1 | Assign Coordinator | M02: Project | high | __André Pereira__ | 100% |
| US6.1 | Login Admin Account | M06: User Administration | high | __André Pereira__ | 100% |
| US6.2 | Administer User | M06: User Administration | high | __André Pereira__ | 100% |
| US6.6 | Browse Projects | M06: User Administration | high | __André Pereira__ | 100% |
| US6.5 | Delete User | M06: User Administration | high | __André Pereira__ | 100% |
| US0.1 | See Home | M07: Static Pages | high | __Beatriz Santos__ | 100% |
| US0.2 | See About| M07: Static Pages | high | __Ricardo Ferreira__ | 100% |
| US0.3 | Contact Team | M07: Static Pages | medium | __Ricardo Ferreira__ | 100% |
| US0.4 | Consult Services | M07: Static Pages | medium | __Ricardo Ferreira__ | 100% |
| US4.5 | Invite Users | M05: Invites and Notifications | low | __André Pereira__ | 100% |
| US2.9 | View notifications | M05: Invites and Notifications | high | __Beatriz Santos__ | 100% |
| US2.11 | Receive Notifications | M05: Invites and Notifications | high | __Beatriz Santos__ | 100% |
| US4.3 | Remove Member | M02: Project | high | __André Pereira__ | 100% |
| US3.3 | Assign Tasks | M03: Tasks and Comments | high | __André Pereira__ | 100% |
| US3.11 | Browse the Project Forum | M04: Project Forum and Labels | medium | __Matilde Oliveira__ | 100% |
| US3.12 | Post messages to Project Forum | M04: Project Forum and Labels | medium | __Matilde Oliveira__ | 100% |
| US3.5 | Comment Tasks | M03: Tasks and Comments | high | __Matilde Oliveira__ | 100% |
| US4.4 | Archive Project | M02: Project | high | __André Pereira__, Matilde Oliveira | 100% |
| US4.7 | Create Label | M04: Project Forum and Labels | low | __Matilde Oliveira__, Beatriz Santos | 100% |
| US4.8 | Delete Label | M04: Project Forum and Labels | low | __Beatriz Santos__,Matilde Oliveira | 100% |
| US3.14 | Assign Label to Task | M04: Project Forum and Labels | low | __Matilde Oliveira__, Beatriz Santos | 100% |
| US3.15 | Delete Label from Task | M04: Project Forum and Labels | low | __Beatriz Santos__,Matilde Oliveira | 100% |
| US6.3 | Block User | M06: User Administration | high | __André Pereira__ | 100% |
| US6.4 | Unblock User | M06: User Administration | high | __André Pereira__ | 100% |
| US2.8 | Upload Profile Pictures | M01: Authentication and Individual Profile | high | __André Pereira__, Beatriz Santos | 100% |
| US2.12 | Accept project invitations | M05: Invites and Notifications | high | __Ricardo Ferreira__ | 100% |
| US2.13 | Project Invitation | M05: Invites and Notifications | low | __Ricardo Ferreira__ | 100% |
| US1.5 | Reset Password | M01: Authentication and Individual Profile | low | __André Pereira__ | 100% |
| US4.6 | Manage Members Permissions | M02: Project | low || 0% |
| US2.10 | Appeal for unblock | M06: User Administration | high || 0% |
| US5.1 | Edit Post | M04: Project Forum and Labels | low || 0% |
| US5.2 | Delete Post | M04: Project Forum and Labels | low || 0% |
| US1.3 | OAuth API Sign-up | M01: Authentication and Individual Profile | very low | | 0% |
| US1.4 | OAuth API Sign-in | M01: Authentication and Individual Profile | very low | | 0% |

## A10: Presentation
 
> This artefact corresponds to the presentation of the product.

### 1. Product presentation

> Brief presentation of the product and its main features (2 paragraphs max).  
>
> URL to the product: http://lbaw21gg.lbaw.fe.up.pt  
>
> Slides used during the presentation should be added, as a PDF file, to the group's repository and linked to here.


### 2. Video presentation

> Screenshot of the video plus the link to the lbaw21gg.mp4 file  

> - Upload the lbaw21gg.mp4 file to the video uploads' [Google folder](https://drive.google.com/drive/folders/1HDNOZ4y834m7pXgJ0XjNa_ZC26e9-Xge?usp=sharing "Videos folder"). You need to use a Google U.Porto account to upload the video.   
> - The video must not exceed 2 minutes.
> - Include a link to the video on the Google Drive folder.


---

## Revision history

Changes made to the first submission:


***

GROUP2102, 22/02/2022

* André Pereira, up201905650@up.pt
* Beatriz Lopes dos Santos, up201906888@up.pt
* Matilde Oliveira, up201906954@up.pt (editor)
* Ricardo Ferreira, up201907835@up.pt
