function addEventListeners() {

    /*--------------project------------*/

    let projectDeleters = document.querySelectorAll('#delete-project .confirm');
    [].forEach.call(projectDeleters, function(deleter) {
        deleter.addEventListener('click', sendDeleteProjectRequest);
    });

    let participationDeleters = document.querySelectorAll('#leave-project .confirm');
    [].forEach.call(participationDeleters, function(deleter) {
        deleter.addEventListener('click', sendDeleteParticipationRequest);
    });

    let projectCreator = document.querySelector('#project-create form.create');
    if (projectCreator != null)
        projectCreator.addEventListener('submit', sendCreateProjectRequest);

    let projectFavs = document.querySelectorAll('article.project .content a.fav');
    [].forEach.call(projectFavs, function(fav) {
        fav.addEventListener('click', sendFavouriteRequest);
    });

    let projectArchived = document.querySelectorAll('article.project .content a.archive');
    [].forEach.call(projectArchived, function(arch) {
        arch.addEventListener('click', sendArchivedRequest);
    });

    let projectEdit = document.querySelector('#project-edit form.edit');
    if (projectEdit != null)
        projectEdit.addEventListener('submit', sendEditProjectRequest);

    let projectCoordinatorAddSearch = document.querySelectorAll('#add-coordinator .search');
    [].forEach.call(projectCoordinatorAddSearch, function(search) {
        search.addEventListener('input', projectCoordinatorAddSearchChange);
    });

    let addCoordinator = document.querySelectorAll('#add-coordinator button.confirm');
    [].forEach.call(addCoordinator, function(user) {
        user.addEventListener('click', addCoordinatorRequest);
    });

    let projectSearchTask = document.querySelectorAll('#task-search ');
    [].forEach.call(projectSearchTask, function(search) {
        search.addEventListener('input', projectSearchTaskChange);
    });

    let projectRemoveMember = document.querySelectorAll('#project-edit .user.remove button');
    [].forEach.call(projectRemoveMember, function(user) {
        user.addEventListener('click', projectRemoveMemberRequest);
    });

    let projectRemoveCoordinator = document.querySelectorAll('#project-edit .user.decrease button');
    [].forEach.call(projectRemoveCoordinator, function(user) {
        user.addEventListener('click', projectRemoveCoordinatorRequest);
    });

    let projectFilters = document.querySelectorAll('#projects .filters input[type=checkbox]');
    [].forEach.call(projectFilters, function(filter) {
        filter.addEventListener('click', projectFilterChange);
    });

    /*--------------task------------*/

    let taskAssignSearch = document.querySelectorAll('#task-create .search');
    [].forEach.call(taskAssignSearch, function(search) {
        search.addEventListener('input', taskAssignSearchChange);
    });

    let taskDetailsAssignSearch = document.querySelectorAll('#task-details .search');
    [].forEach.call(taskDetailsAssignSearch, function(search) {
        search.addEventListener('input', taskAssignSearchChange);
    });

    let taskCreator = document.querySelector('#task-create form.create');
    if (taskCreator != null)
        taskCreator.addEventListener('submit', sendCreateTaskRequest);

    let taskCreatorAssign = document.querySelectorAll('#task-create .modal .confirm');
    [].forEach.call(taskCreatorAssign, function(val) {
        val.addEventListener('click', createTaskAssignHandler);
    });

    let taskAssignMember = document.querySelectorAll('#task-details .modal .confirm');
    [].forEach.call(taskAssignMember, function(val) {
        val.addEventListener('click', taskAssignMemberHandler);
    });

    let taskEdit = document.querySelector('#task-edit form.edit');
    if (taskEdit != null) {
        taskEdit.addEventListener('submit', sendEditTaskRequest);
    }

    let taskComplete = document.querySelector('#task-details button.complete');
    if (taskComplete != null) {
        taskComplete.addEventListener('click', sendCompleteTaskRequest);
    }

    let taskRemoveMember = document.querySelectorAll('#task-edit .user.remove button');
    [].forEach.call(taskRemoveMember, function(user) {
        user.addEventListener('click', taskRemoveMemberRequest);
    });

    /*--------------forum message------------*/

    let forumMessageCreator = document.querySelector('#project form.new-message');
    if (forumMessageCreator != null)
        forumMessageCreator.addEventListener('submit', sendCreateForumMessageRequest);

    /*--------------task comment------------*/

    let commentCreator = document.querySelector('#task-details form.new-message');
    if (commentCreator != null)
        commentCreator.addEventListener('submit', sendCreateCommentRequest);


    /*--------------label------------*/
    let labelCreator = document.querySelector('#add-label .modal-footer .btn.save');
    if (labelCreator != null)
        labelCreator.addEventListener('click', sendCreateLabelRequest);

    let labelAssigner = document.querySelectorAll('#assign-label .modal-body .btn.assign-label');
    [].forEach.call(labelAssigner, function(user) {
        user.addEventListener('click', sendAssignLabelRequest);
    });

    let labelDeleter = document.querySelectorAll('#project-edit .labels .content .btn.remove');
    [].forEach.call(labelDeleter, function(user) {
        user.addEventListener('click', sendDeleteLabelRequest);
    });

    /*--------------user------------*/

    let userEdit = document.querySelector('#user-edit form.info');
    if (userEdit != null)
        userEdit.addEventListener('submit', sendEditUserRequest);

    let userDelete = document.querySelectorAll('#delete-user .delete');
    [].forEach.call(userDelete, function(val) {
        val.addEventListener('click', sendDeleteUserRequest);
    });

    let imageUpload = document.querySelector('#user-edit #photo .confirm');
    if (imageUpload != null)
        imageUpload.addEventListener('click', sendImageUploadRequest);

    /*--------------invite------------*/

    let projectUserAddSearch = document.querySelectorAll('#invite-member .search');
    [].forEach.call(projectUserAddSearch, function(search) {
        search.addEventListener('input', projectUserAddSearchChange);
    });

    let userInvite = document.querySelectorAll('#invite-member button.confirm');
    [].forEach.call(userInvite, function(user) {
        user.addEventListener('click', sendInviteRequest);
    });

    let acceptInvite = document.querySelectorAll('#notifications .notification .accept');
    [].forEach.call(acceptInvite, function(invite) {
        invite.addEventListener('click', acceptInviteRequest);
    })

    let cancelInvite = document.querySelectorAll('#notifications .notification .cancel');
    [].forEach.call(cancelInvite, function(invite) {
        invite.addEventListener('click', rejectInviteRequest);
    })

    /*--------------email------------*/

    let sendEmail = document.querySelector('#contact form');
    if (sendEmail != null)
        sendEmail.addEventListener('submit', sendEmailRequest);

    /*--------------admin-------------*/

    let adminUserSearch = document.querySelector('#admin .search')
    if (adminUserSearch != null)
        adminUserSearch.addEventListener('input', adminUserSearchChange);

    let adminUserBlock = document.querySelectorAll('#admin .user .block button, #admin .user .unblock button');
    [].forEach.call(adminUserBlock, function(block) {
        block.addEventListener('click', sendUserBlockRequest);
    });

    /*--------------notifications-------------*/

    let notification = document.querySelectorAll('#notifications .link');
    [].forEach.call(notification, function(id) {
        id.addEventListener('click', seeNotification);
    });
}

/*--------------Utils------------*/

function encodeForAjax(data) {
    if (data == null) return null;
    return Object.keys(data).map(function(k) {
        return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
    }).join('&');
}

function sendAjaxRequest(method, url, data, handler) {
    let request = new XMLHttpRequest();

    request.open(method, url, true);
    request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener('load', handler);
    request.send(encodeForAjax(data));
}

/*--------------Project------------*/

function sendDeleteParticipationRequest(event) {
    event.preventDefault();
    let user_id = event.target.getAttribute('data-id');
    let project_id = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', { user_id }, participationDeletedHandler);
    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', { user_id }, null);
}

function sendDeleteProjectRequest(event) {
    event.preventDefault();
    let id = this.closest('button').getAttribute('data-id');

    sendAjaxRequest('delete', '/projects/' + id, null, projectDeletedHandler);
}

function sendCreateProjectRequest(event) {
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let color = this.querySelector('input[name=color]').value;
    if (name == '') {

        let message = document.querySelectorAll('#project-create form .buttons .error-messages');
        [].forEach.call(message, function(mes) {
            mes.remove();
        });
        console.log("project does not have a name");
        let buttonsDiv = document.querySelector('#project-create form .buttons');
        let buttonSave = document.querySelector('#project-create form .buttons button.save');

        let errorMessage = document.createElement('span');
        errorMessage.className = ('error-messages')
        errorMessage.innerHTML = `Project does not have a name!`;

        buttonsDiv.insertBefore(errorMessage, buttonSave);
    } else if (name != '') {
        sendAjaxRequest('post', '/projects/', { name, description, color }, projectAddedHandler);
    }

    event.preventDefault();
}

function sendEditProjectRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let color = this.querySelector('input[name=color]').value;

    if (name != '')
        sendAjaxRequest('post', '/projects/' + id + '/edit', { name, description, color }, projectEditHandler);

    event.preventDefault();
}

function sendFavouriteRequest(event) {
    event.preventDefault();
    let id = this.closest('article').getAttribute('data-id');
    sendAjaxRequest('post', '/api/projects/' + id + '/favourite', null, projectFavouriteHandler);
}

function sendArchivedRequest(event) {
    event.preventDefault();
    let id = this.closest('article').getAttribute('data-id');
    console.log(id);
    sendAjaxRequest('post', '/api/projects/' + id + '/archive', null, projectArchiveHandler);
}

function sendFavouritesProjectRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let color = this.querySelector('input[name=color]').value;

    if (name != '')
        sendAjaxRequest('post', '/projects/' + id + '/edit', { name, description, color }, projectEditHandler);

    event.preventDefault();
}

function projectCoordinatorAddSearchChange(event) {
    event.preventDefault();

    let search = event.target.value;
    let inProject = event.target.getAttribute('data-id');
    let isMember = true;

    sendAjaxRequest('post', '/api/users/', { inProject, search, isMember }, projectCoordinatorAddSearchChangeHandler);
}

function addCoordinatorRequest(event) {
    event.preventDefault();

    let id_user = event.target.getAttribute('data-id');
    let id_project = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('post', '/api/projects/addCoordinator', { id_user, id_project }, addCoordinatorHandler);
}

function projectSearchTaskChange(event) {
    event.preventDefault();

    let search = event.target.value;
    let project_id = this.closest('section').getAttribute('data-id');
    let finished = false;

    sendAjaxRequest('post', '/api/tasks', { project_id, search, finished }, projectSearchTaskHandler);
}

function projectRemoveMemberRequest(event) {
    event.preventDefault();

    let user_id = event.target.getAttribute('data-id');
    let project_id = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', { user_id }, projectRemoveMemberHandler);
}

function projectRemoveCoordinatorRequest(event) {
    event.preventDefault();

    let user_id = event.target.getAttribute('data-id');
    let project_id = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', { user_id }, projectRemoveCoordinatorHandler);
}

function projectFilterChange(event) {
    const filters = document.querySelector("#projects .filters");

    const favourite = filters.querySelector("#favourite").checked;
    const coordinator = filters.querySelector("#coordinator").checked;
    const member = filters.querySelector("#member").checked;
    const archived = filters.querySelector("#archived").checked;

    const search = document.querySelector("#projects #search").value;

    const orderElem = document.querySelector("#projects [name=order]:checked");
    let order = null;
    if (orderElem !== null) {
        order = orderElem.value;
    }


    sendAjaxRequest('post', '/api/projects/', { favourite, coordinator, member, archived, search, order }, projectFilterChangeHandler);
}

/*--------------Task------------*/

function sendCreateTaskRequest(event) {
    event.preventDefault();
    let projectId = this.querySelector('input[name=project-id]').value;
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let priority = this.querySelector('input[name=priority]').value;
    let dueDate = this.querySelector('input[name=date]').value;
    let users = this.querySelectorAll("input[name='user-id[]']");

    if (name == '') {
        let message = document.querySelectorAll('#task-create form .buttons .error-messages');
        [].forEach.call(message, function(mes) {
            mes.remove();
        });
        console.log("project does not have a name");
        let buttonsDiv = document.querySelector('#task-create form .buttons');
        let buttonSave = document.querySelector('#task-create form .buttons button.save');

        let errorMessage = document.createElement('span');
        errorMessage.className = ('error-messages')
        errorMessage.innerHTML = `Task does not have a name!`;

        buttonsDiv.insertBefore(errorMessage, buttonSave);
    } else {
        users.forEach((user) => {
            if (user.value === '' && users.length === 1) {

                sendAjaxRequest('post', '/tasks', { name, description, priority, projectId, dueDate, userId: '' }, taskAddedHandler);
            } else if (user.value !== '') {
                let userId = user.value
                sendAjaxRequest('post', '/tasks', { name, description, priority, projectId, dueDate, userId }, taskAddedHandler);
            }

        })
    }
}

function sendEditTaskRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let priority = this.querySelector('input[name=priority]').value;
    let dueDate = this.querySelector('input[name=date]').value;

    if (name != '')
        sendAjaxRequest('post', '/tasks/' + id + '/edit', { name, description, priority, dueDate }, taskEditHandler);

}

function sendCompleteTaskRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let day = new Date().toISOString().slice(0, 10);
    let time = new Date().toISOString().slice(11, 19);

    const today = day + ' ' + time;
    if (id != undefined) //change route
        sendAjaxRequest('post', '/tasks/' + id + '/complete', { today }, taskEditHandler);

}

function taskAssignSearchChange(event) {
    event.preventDefault();

    let search = event.target.value;
    let inProject = event.target.getAttribute('data-id');

    sendAjaxRequest('post', '/api/users/', { inProject, search }, taskAssignSearchChangeHandler);
}

function taskAssignMemberHandler(event) {
    event.preventDefault();

    let user = document.querySelector('#task-details .assigned .user');
    let id = this.closest('section').getAttribute('data-id');
    let userId = this.getAttribute('data-id');
    if (user === null) {
        sendAjaxRequest('post', '/tasks/' + id + '/edit', { userId }, taskEditHandler);
    } else {
        sendAjaxRequest('post', '/tasks/' + id + '/clone', { userId }, taskEditHandler);
    }

}

function taskRemoveMemberRequest(event) {
    event.preventDefault();

    let id_user = null;
    let task_id = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('post', '/tasks/' + task_id + '/edit', { id_user }, taskRemoveMemberHandler);
}

/*--------------Forum Messages------------*/

function sendCreateForumMessageRequest(event) {
    event.preventDefault();
    let projectId = this.closest('section').getAttribute('data-id');
    let content = this.querySelector('input[name=content]').value;
    let userId = event.target.getAttribute('data-id');

    if (content != '')
        sendAjaxRequest('post', '/messages', { projectId, content, userId }, ForumMessageAddedHandler);
}

/*--------------Task Comment------------*/

function sendCreateCommentRequest(event) {
    event.preventDefault();
    let taskId = this.closest('section').getAttribute('data-id');
    let content = this.querySelector('input[name=content]').value;
    let userId = event.target.getAttribute('data-id');
    if (content != '')
        sendAjaxRequest('post', '/comments', { taskId, content, userId }, CommentAddedHandler);
}

/*-----------------Label---------------*/

function sendCreateLabelRequest(event) {
    event.preventDefault();
    let projectId = this.closest('section').getAttribute('data-id');
    let name = document.querySelector('#add-label .modal-body input').value;

    if (name != '')
        sendAjaxRequest('post', '/labels', { projectId, name }, LabelAddedHandler);
}

function sendAssignLabelRequest(event) {
    event.preventDefault();
    let taskId = this.closest('section').getAttribute('data-id');
    let labelId = this.closest('div').getAttribute('data-id');

    if (taskId != undefined)
        sendAjaxRequest('post', '/labels/assign', { taskId, labelId }, LabelAssignedHandler);
}

function sendDeleteLabelRequest(event) {
    event.preventDefault();
    let projectId = this.closest('section').getAttribute('data-id');
    let labelId = this.closest('div').getAttribute('data-id');
    if (projectId != undefined)
        sendAjaxRequest('delete', '/labels/' + labelId, { projectId, labelId }, LabelDeletedHandler);
}

/*--------------User------------*/

function sendEditUserRequest(event) {

    event.preventDefault();
    let id = this.closest('article').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let email = this.querySelector('input[name=email]').value;
    let password = this.querySelector('input[name=password]').value;
    let cpassword = this.querySelector('input[name=cPassword]').value;
    if (password == cpassword) {

        if (sendAjaxRequest('post', '/users/' + id + '/update', { name, email, password }, userEditHandler)) {
            this.querySelector('#error').style.display = "flex";
        }
    } else {
        this.querySelector('#error').style.display = "flex";
    }
}

function sendDeleteUserRequest(event) {
    event.preventDefault();
    let id = this.closest('button').getAttribute('data-id');

    sendAjaxRequest('delete', '/users/' + id, null, userDeletedHandler);
}

function sendImageUploadRequest(event) {
    event.preventDefault();

    let image = document.querySelector('#photo .uploadPhoto input').files[0];
    let id = this.getAttribute('data-id');

    const formData = new FormData();
    formData.append('image', image, Blob);
    formData.append("boas", "texto");
    console.log(formData.get('image'));
    console.log(formData);
    console.log(formData.image)
    if (image !== null) {
        sendAjaxRequest('post', '/api/users/' + id + '/uploadImage', formData, imageUploadRequestHandler);
    }
}
/*--------------Invite------------*/

function projectUserAddSearchChange(event) {
    event.preventDefault();

    let search = event.target.value;
    let notInProject = event.target.getAttribute('data-id');

    sendAjaxRequest('post', '/api/users/', { notInProject, search }, projectUserAddSearchChangeHandler);

}

function sendInviteRequest(event) {
    event.preventDefault();

    let id_user = event.target.getAttribute('data-id');
    let id_project = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('post', '/api/invites', { id_user, id_project }, sendInviteHandler);
}

function acceptInviteRequest(event) {
    event.preventDefault();
    let id_user = this.closest('.user').getAttribute('data-id');
    let id_project = this.getAttribute('data-id');

    sendAjaxRequest('post', '/api/invites/search', { id_project, id_user }, searchAcceptInviteHandler);
}

function rejectInviteRequest(event) {
    event.preventDefault();
    let id_user = this.closest('.user').getAttribute('data-id');
    let id_project = this.getAttribute('data-id');

    sendAjaxRequest('post', '/api/invites/search', { id_project, id_user }, searchRejectInviteHandler);
}


/*--------------Email------------*/

function sendEmailRequest(event) {
    event.preventDefault();
    let name = this.querySelector('input[name=name]').value;
    let email = this.querySelector('input[name=email]').value;
    let message = this.querySelector('textarea[name=message]').value;
    sendAjaxRequest('post', '/contact/sendEmail', { name, email, message }, sendEmailHandler)
}

/*--------------Admin------------*/

function adminUserSearchChange(event) {
    event.preventDefault();

    let search = event.target.value;

    sendAjaxRequest('post', '/api/users/', { search }, adminUserSearchChangeHandler);

}

function sendUserBlockRequest(event) {
    event.preventDefault();
    let user_id = this.closest('article').getAttribute('data-id');
    sendAjaxRequest('post', '/api/block/' + user_id, null, userBlockHandler);
}

/*--------------Notification------------*/

function seeNotification(event) {
    event.preventDefault();
    let user_id = this.closest('.user').getAttribute('data-id');
    let notification_id = this.closest('article').getAttribute('data-id');
    let project_id = 0;
    sendAjaxRequest('post', '/users/' + user_id + '/notifications', { user_id, notification_id, project_id }, notificationHandler);

}

/* HANDLERS */

/*--------------Project------------*/

function participationDeletedHandler() {
    if (this.status == 406) {
        alert("Last coordinator! Can't leave project.")
    } else if (this.status == 200) {
        window.location = '/users';
    } else {
        alert("Error: Can't leave project");
    }
}

function projectDeletedHandler() {
    if (this.status == 200) {
        window.location = '/users';
    } else {
        alert("Error: Could not delete project");
    }
}

function projectAddedHandler() {
    const project = JSON.parse(this.responseText);
    if (this.status === 201) {
        window.location = '/projects/' + project.id;
    } else if (this.status !== 200) {
        window.location = '/';
    }
}

function projectEditHandler() {
    const project = JSON.parse(this.responseText);
    if (this.status === 201 || this.status === 200) {
        window.location = '/projects/' + project.id + '/details';
    } else {
        window.location = '/';
    }
}

function projectFavouriteHandler() {
    if (this.status != 200) window.location = '/';

    let participation = JSON.parse(this.responseText);
    const img = document.querySelector('article.project[data-id="' + participation.id_project + '"] .content .fav img');

    if (img.getAttribute('src').includes("filed_star")) {
        img.setAttribute('src', window.location.origin + '/img/star.png');
    } else {
        img.setAttribute('src', window.location.origin + '/img/filed_star.png');
    }
}

function projectArchiveHandler() {

    if (this.status != 200) window.location = '/';

    let project = JSON.parse(this.responseText);
    const img = document.querySelector('article.project[data-id="' + project.id + '"] .content .archive img');

    if (img.getAttribute('src').includes("box")) {
        img.setAttribute('src', window.location.origin + '/img/cardboard-box-filled.png');
        img.setAttribute('class', '');
    }
}

function addCoordinatorHandler() {
    if (this.status != 200) window.location = '/';
    let user = JSON.parse(this.responseText);
    let element = document.querySelector('.user.invite[data-id="' + user.id + '"]');
    element.remove();

    let member = document.querySelector('#project-details .members .user[data-id="' + user.id + '"]');
    member.remove();

    let body = document.querySelector('#project-details .coordinators .content');
    let button = document.querySelector('#project-details .coordinators .content button');

    let coordinator = document.createElement('div');
    coordinator.className = ('user');
    coordinator.setAttribute('data-id', user.id);
    // if(user.image_path !== "./img/default"){
    //     console.log("entrie");
    //     coordinator.innerHTML = `

    //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
    //     <a href="/users/${user.id}/profile">${user.name}</a>`;
    // }
    // else{
    coordinator.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${user.id}/profile">${user.name}</a>`;
    //}

    body.insertBefore(coordinator, button);

}

function projectCoordinatorAddSearchChangeHandler() {
    const users = JSON.parse(this.responseText);

    let addCoordinator = document.querySelectorAll('#add-coordinator .user.invite');
    [].forEach.call(addCoordinator, function(add) {
        add.remove();
    });


    let body = document.querySelector('#add-coordinator .modal-body');
    users.map((user) => {
        let add_coordinator = document.createElement('div');
        add_coordinator.className = ('user invite');
        add_coordinator.setAttribute('data-id', user.id);

        // if(user.image_path !== "./img/default"){
        //     console.log("entrie");
        //     add_coordinator.innerHTML = `

        //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
        //     <a href="/users/${user.id}/profile/">${user.name}</a>
        //     <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;
        // }
        // else{
        add_coordinator.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${user.id}/profile/">${user.name}</a>
        <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;
        //}

        // add_coordinator.innerHTML = `

        //     <img src="https://picsum.photos/200" alt="User image" width="70px">
        //      <a href="/users/${user.id}/profile/">${user.name}</a>
        //      <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;

        let add = add_coordinator.querySelector('button.confirm');
        add.addEventListener('click', createTaskAssignHandler);

        body.appendChild(add_coordinator);
    })
}

function projectUserAddSearchChangeHandler() {
    const users = JSON.parse(this.responseText);

    let userInvite = document.querySelectorAll('#invite-member .user.invite');
    [].forEach.call(userInvite, function(invite) {
        invite.remove();
    });


    let body = document.querySelector('#invite-member .modal-body');
    users.map((user) => {
        let user_invite = document.createElement('div');
        user_invite.className = ('user invite');
        user_invite.setAttribute('data-id', user.id);

        // if(user.image_path !== "./img/default"){
        //     console.log("entrie");
        //     user_invite.innerHTML = `

        //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
        //     <a href="/users/${user.id}/profile/">${user.name}</a>
        //     <a href="/users/${user.id}/profile/">${user.name}</a>
        //     <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;
        // }
        // else{
        user_invite.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${user.id}/profile/">${user.name}</a>
        <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;
        //}


        // user_invite.innerHTML = `

        //     <img src="https://picsum.photos/200" alt="User image" width="70px">
        //      <a href="/users/${user.id}/profile/">${user.name}</a>
        //      <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;

        let invite = user_invite.querySelector('button.confirm');
        invite.addEventListener('click', sendInviteRequest);

        body.appendChild(user_invite);
    })
}

function sendInviteHandler() {
    if (this.status != 201) window.location = '/';
    let invite = JSON.parse(this.responseText);
    let element = document.querySelector('.user.invite[data-id="' + invite.id_user + '"]');
    element.remove();
}

function searchAcceptInviteHandler() {
    let invite = JSON.parse(this.responseText);
    sendAjaxRequest('post', '/api/invites/' + invite.id + '/accept', null, null);
    sendAjaxRequest('delete', '/api/invites/' + invite.id, null, buttonsInviteHandler);
}

function searchRejectInviteHandler() {
    let invite = JSON.parse(this.responseText);
    sendAjaxRequest('delete', '/api/invites/' + invite.id, null, buttonsInviteHandler);
}


function buttonsInviteHandler() {
    if (this.status != 200) window.location = '/';
    let invite = JSON.parse(this.responseText);
    let accept = document.querySelectorAll('#notifications .notification .accept[data-id="' + invite.id_project + '"]');
    accept.forEach(buttons => {
        buttons.remove();
    })
    let decline = document.querySelectorAll('#notifications .notification .cancel[data-id="' + invite.id_project + '"]');
    decline.forEach(buttons => {
        buttons.remove();
    })
}

function projectSearchTaskHandler() {
    const tasks = JSON.parse(this.responseText);

    let taskList = document.querySelectorAll('#project .todo-box .task');
    [].forEach.call(taskList, function(task) {
        task.remove();
    });

    let body = document.querySelector('#project .todo-box ul');
    tasks.map((task) => {
        let taskLi = document.createElement('li');
        taskLi.className = ('task');
        taskLi.setAttribute('data-id', task.id);
        taskLi.innerHTML = `

            <a href="/tasks/${ task.id }" class="name">${ task.name }</a>
            <span class="number">${task.task_number+1}</span>`;

        body.appendChild(taskLi);
    })
}


function projectRemoveMemberHandler() {
    if (this.status != 200) window.location = '/';
    let userData = JSON.parse(this.responseText);

    let member = document.querySelector('#project-edit .members .user[data-id="' + userData.id + '"]');
    member.remove();
}

function taskRemoveMemberHandler() {
    if (this.status != 200) window.location = '/users';
    let user = JSON.parse(this.responseText);

    let member = document.querySelector('#task-edit .assigned .user[data-id="' + user.id + '"]');
    member.remove();
}

function projectRemoveCoordinatorHandler() {
    if (this.status === 406) {
        alert("Last coordinator! Can't leave project.")
    } else if (this.status !== 200) {
        alert("Error: Can't leave project");
        window.location = '/users';
    }

    let userData = JSON.parse(this.responseText);

    let member = document.querySelector('#project-edit .coordinators .user[data-id="' + userData.id + '"]');
    member.remove();

    let body = document.querySelector('#project-edit .members .content');

    let user = document.createElement('div');
    user.className = ('user remove');
    user.setAttribute('data-id', userData.id);
    // if(user.image_path !== "./img/default"){
    //     console.log("entrie");
    //     coordinator.innerHTML = `

    //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
    //     <a href="/users/${user.id}/profile">${user.name}</a>`;
    // }
    // else{
    user.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${userData.id}/profile">${userData.name}</a>
        <button type="button" class="btn remove" data-id=${userData.id}>Remove</button>`;
    //}

    body.appendChild(user);
}

function projectFilterChangeHandler() {
    if (this.status != 200) window.location = '/users';

    const projects = JSON.parse(this.responseText);

    let firstErase = false;
    let currProjects = document.querySelectorAll('#projects .projets-display article.project');
    [].forEach.call(currProjects, function(project) {
        if (!firstErase) {
            firstErase = true;
        } else {
            project.remove();
        }
    });

    let body = document.querySelector('#projects .projets-display');
    projects.map((project) => {
                let addProject = document.createElement('article');
                addProject.className = (`project id-${project.id}`);
                addProject.setAttribute('data-id', project.id);
                addProject.innerHTML = `
                    <header>
                        <h3><a href="/projects/${ project.id }">${ project.name }</a></h3>
                    </header>
                    <div class="content">
                        ${ project.pivot.role === "Coordinator"  ?
                                 project.archived_at === null ?
                                    `<a href="/archive_project" class="archive" ><img src="../img/cardboard-box.png"  width="20px"> </a>`
                                    :
                                    `<a href="/archive_project"><img src="../img/cardboard-box-filled.png" width="20px"> </a>`
                            :
                            ''
                        }

                        ${project.pivot.favourite ?
                            `<a href="#" class="fav"><img src="../img/filed_star.png" width="20px"></a>`
                            :
                            `<a href="#" class="fav"><img src="../img/star.png" width="20px"></a> `
                        }
                    </div>`;

        let fav = addProject.querySelector('a.fav');
        fav.addEventListener('click', sendFavouriteRequest);

        let archive = addProject.querySelector('a.archive');
        if(archive != null){
            archive.addEventListener('click', sendArchivedRequest);
        }

        body.appendChild(addProject);

    })
}


/*--------------Task------------*/

function createTaskAssignHandler(event) {
    event.preventDefault();

    // let remove = document.querySelectorAll('#task-create .coordinators .user');
    // [].forEach.call(remove, function(del) {
    //     del.remove();
    // });

    let id_user = event.target.getAttribute('data-id');
    //document.querySelector('#task-create input[name=user-id[]]').value = id_user;

    let input = document.querySelector('#task-create .coordinators input').cloneNode(true);
    input.value = id_user

    let user = document.querySelector('#task-create .user[data-id="' + id_user + '"]').cloneNode(true);
    // user.remove();
    user.querySelector('button').remove();

    let body = document.querySelector('#task-create .coordinators .content');
    let button = document.querySelector('#task-create .coordinators .content button');

    body.insertBefore(user, button);
    body.appendChild(input);

}

function taskAddedHandler() {
    const task = JSON.parse(this.responseText);
    if (this.status === 201) {
        window.location = '/tasks/' + task.id;
    } else if (this.status !== 200) {
        window.location = '/';
    }
}

function taskEditHandler() {
    const task = JSON.parse(this.responseText);
    if (this.status === 201 || this.status === 200) {
        window.location = '/tasks/' + task.id;
    } else {
        window.location = '/';
    }
}

function taskAssignSearchChangeHandler() {
    const users = JSON.parse(this.responseText);

    let assigned = document.querySelectorAll('.user.invite');
    [].forEach.call(assigned, function(val) {
        val.remove();
    });


    let body = document.querySelector('.modal-body');
    users.map((user) => {
        let assign = document.createElement('div');
        assign.className = ('user invite');
        assign.setAttribute('data-id', user.id);


        // if(user.image_path !== "./img/default"){
        //     console.log("entrie");
        //     assign.innerHTML = `

        //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
        //     <a href="/users/${user.id}/profile">${user.name}</a>
        //     <button type="button" class="btn confirm" data-id=${user.id}>Add</button>`;
        // }
        // else{
        assign.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${user.id}/profile">${user.name}</a>
        <button type="button" class="btn confirm" data-id=${user.id}>Add</button>`;
        //}


        // assign.innerHTML = `

        //     <img src="https://picsum.photos/200" alt="User image" width="70px">
        //      <a href="/users/${user.id}/profile">${user.name}</a>
        //      <button type="button" class="btn confirm" data-id=${user.id}>Add</button>`;

        let add = assign.querySelector('button.confirm');
        add.addEventListener('click', addCoordinatorRequest);

        body.appendChild(assign);
    })
}

/*--------------Forum Message------------*/

function ForumMessageAddedHandler() {
    const message = JSON.parse(this.responseText);
    if (this.status === 201) {
        window.location = '/projects/' + message.id_project;
    } else if (this.status !== 200) {
        window.location = '/';
    }
}

/*--------------Task Comment------------*/

function CommentAddedHandler() {
    const message = JSON.parse(this.responseText);
    if (this.status === 201) {
        window.location = '/tasks/' + message.id_task;
    } else if (this.status !== 200) {
        window.location = '/';
    }
}

/*--------------Label------------*/

function LabelAddedHandler() {

    if (this.status != 201) window.location = '/';

    let label = JSON.parse(this.responseText);

    let body = document.querySelector('#project-details .labels .content');
    let button = document.querySelector('#project-details .labels .content button');

    let labelHTML = document.createElement('div');
    labelHTML.className = ('user');
    labelHTML.setAttribute('data-id', label.id);

    labelHTML.innerHTML = `<span>${label.name}</span>`;

    body.insertBefore(labelHTML, button);

}

function LabelAssignedHandler() {
    const message = JSON.parse(this.responseText);
    if (this.status === 201) {
        window.location = '/tasks/' + message.id_task;
    } else if (this.status !== 200) {
        window.location = '/';
    }
}

function LabelDeletedHandler() {
    if (this.status !== 200) {
        window.location = '/';
    }
    let label = JSON.parse(this.responseText);
    document.querySelector('#project-edit .labels .content .user[data-id="' + label + '"]').remove();
}

/*--------------User------------*/

function userEditHandler() {
    const user = JSON.parse(this.responseText);
    if (this.status === 200) {
        window.location = '/users/' + user.id + '/profile';
    } else if (this.status !== 201) {
        window.location = '/';
    }
}

function userDeletedHandler() {
    if (this.status === 200) {
        window.location = '/';
    } else {
        alert("Error deleting account");
    }

}

function imageUploadRequestHandler(){
    console.log(this.status);
    console.log(this.responseText);
}

/*--------------Email------------*/

function sendEmailHandler() {
    if (this.status === 200) {
        window.location = '/contact';
    } else if (this.status !== 201) {
        window.location = '/';
    }
}

/*--------------Admin------------*/

function adminUserSearchChangeHandler() {
    const users = JSON.parse(this.responseText);

    let usersList = document.querySelectorAll('#admin .user');
    [].forEach.call(usersList, function(user) {
        user.remove();
    });

    let body = document.querySelector('#admin .users-display');
    users.map((user) => {
        let userDisplay = document.createElement('article');
        userDisplay.className = ('user');
        userDisplay.setAttribute('data-id', user.id);

        if (user.blocked) {
            userDisplay.innerHTML = `
                <div class="unblock">
                    <div class="data">
                        <span class="profilePhoto"></span>

                        <a href="/users/${user.id}/profile">${user.name}</a>
                    </div>

                    <div class="buttons">
                            <button type="button" class="btn">Unblock</button>
                    </div>
                </div>
            `;

        } else {
            userDisplay.innerHTML = `
                <div class="block">
                    <div class="data">
                        <span class="profilePhoto"></span>

                        <a href="/users/${user.id}/profile">${user.name}</a>
                    </div>

                    <div class="buttons">
                            <button type="button" class="btn">Block</button>
                    </div>
                </div>
            `;
        }
        userDisplay.querySelector("button").addEventListener('click', sendUserBlockRequest);

        body.appendChild(userDisplay);
    })
}

function userBlockHandler() {
    if (this.status != 200) window.location = '/';

    let user = JSON.parse(this.responseText);
    const data = document.querySelector('#admin article.user[data-id="' + user.id + '"] div');
    const buttons = data.querySelector(".buttons");
    buttons.querySelector("button").remove();

    let button = document.createElement('button');
    button.className = ('btn');
    button.setAttribute('type', 'button');

    if (user.blocked) {
        data.className = "unblock";
        button.innerHTML = "Unblock";
        button.addEventListener('click', sendUserBlockRequest);
    } else {
        data.className = "block";
        button.innerHTML = "Block";
        button.addEventListener('click', sendUserBlockRequest);
    }

    buttons.appendChild(button);

}

/*--------------Notifications------------*/

function notificationHandler() {
    const id = JSON.parse(this.responseText);
    if (this.status === 200) {
        window.location = '/projects/' + id;
    } else if (this.status !== 500) {
        window.location = '/';
    }
}

addEventListeners();
