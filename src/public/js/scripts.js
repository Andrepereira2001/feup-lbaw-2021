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

    /*--------------user------------*/

    let userEdit = document.querySelector('#user-edit form.info');
    if (userEdit != null)
        userEdit.addEventListener('submit', sendEditUserRequest);

    let userDelete = document.querySelectorAll('#delete-user .delete');
    [].forEach.call(userDelete, function(val) {
        val.addEventListener('click', sendDeleteUserRequest);
    });

    /*--------------invite------------*/

    let projectUserAddSearch = document.querySelectorAll('#invite-member .search');
    [].forEach.call(projectUserAddSearch, function(search) {
        search.addEventListener('input', projectUserAddSearchChange);
    });

    let userInvite = document.querySelectorAll('#invite-member button.confirm');
    [].forEach.call(userInvite, function(user) {
        user.addEventListener('click', sendInviteRequest);
    });

    /*--------------email------------*/

    let sendEmail = document.querySelector('#contact form');
    if (sendEmail != null)
        sendEmail.addEventListener('submit', sendEmailRequest);

    /*--------------admin-------------*/

    let adminUserSearch = document.querySelector('#admin .search')
    if (adminUserSearch != null)
    adminUserSearch.addEventListener('input', adminUserSearchChange);

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
    let id = this.closest('button').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + id + '/leave', null, participationDeletedHandler);
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

    if (name != '')
        sendAjaxRequest('post', '/projects/', { name, description, color }, projectAddedHandler);

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


/*--------------Task------------*/

function sendCreateTaskRequest(event) {
    event.preventDefault();
    let projectId = this.querySelector('input[name=project-id]').value;
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let priority = this.querySelector('input[name=priority]').value;
    let dueDate = this.querySelector('input[name=date]').value;
    let userId = this.querySelector('input[name=user-id]').value;

    if (name != '')
        sendAjaxRequest('post', '/tasks', { name, description, priority, projectId, dueDate, userId }, taskAddedHandler);
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
    let time = new Date().toISOString().slice(10, 19);
    const today = day + time;

    if (id != undefined) //change route
        sendAjaxRequest('post', '/tasks/' + id, { today }, taskEditHandler);

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

    console.log(user, id, userId);
    if (user === null) {
        sendAjaxRequest('post', '/tasks/' + id + '/edit', { userId }, taskEditHandler);
    } else {
        sendAjaxRequest('post', '/tasks/' + id + '/clone', { userId }, taskEditHandler);
    }

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

        if (sendAjaxRequest('post', '/users/profile/' + id + '/update', { name, email, password }, userEditHandler)) {
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


/*--------------Email------------*/

function sendEmailRequest(event) {
    event.preventDefault();
    let name = this.querySelector('input[name=name').value;
    let email = this.querySelector('input[email=email]').value;
    let message = this.querySelector('input[message=message').value;
    sendAjaxRequest('post', '/contact', { name, email, message }, sendEmailHandler)
}

/*--------------Adim------------*/

function adminUserSearchChange(event) {
    event.preventDefault();

    let search = event.target.value;

    sendAjaxRequest('post', '/api/users/', { search }, adminUserSearchChangeHandler);

}

/* HANDLERS */

/*--------------Project------------*/

function participationDeletedHandler() {
    window.location = '/';
}

function projectDeletedHandler() {
    window.location = '/';
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
    coordinator.innerHTML = `

        <img src="https://picsum.photos/200" alt="User image" width="70px">
        <a href="/users/profile/${user.id}">${user.name}</a>`;

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
        add_coordinator.innerHTML = `

            <img src="https://picsum.photos/200" alt="User image" width="70px">
             <a href="/users/profile/${user.id}">${user.name}</a>
             <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;

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
        user_invite.innerHTML = `

            <img src="https://picsum.photos/200" alt="User image" width="70px">
             <a href="/users/profile/${user.id}">${user.name}</a>
             <button type="button" class="btn confirm" data-id=${user.id}>Invite</button>`;

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


/*--------------Task------------*/

function createTaskAssignHandler(event) {
    event.preventDefault();

    let remove = document.querySelectorAll('#task-create .coordinators .user');
    [].forEach.call(remove, function(del) {
        del.remove();
    });

    let id_user = event.target.getAttribute('data-id');
    document.querySelector('#task-create input[name=user-id]').value = id_user;

    let user = document.querySelector('#task-create .user[data-id="' + id_user + '"]').cloneNode(true);
    // user.remove();
    user.querySelector('button').remove();

    let body = document.querySelector('#task-create .coordinators .content');
    let button = document.querySelector('#task-create .coordinators .content button');

    body.insertBefore(user, button);

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
        assign.innerHTML = `

            <img src="https://picsum.photos/200" alt="User image" width="70px">
             <a href="/users/profile/${user.id}">${user.name}</a>
             <button type="button" class="btn confirm" data-id=${user.id}>Add</button>`;

        let add = assign.querySelector('button.confirm');
        add.addEventListener('click', addCoordinatorRequest);

        body.appendChild(assign);
    })
}

/*--------------User------------*/

function userEditHandler() {
    const user = JSON.parse(this.responseText);
    if (this.status === 200) {
        window.location = '/users/profile/' + user.id;
    } else if (this.status !== 201) {
        window.location = '/';
    }
}

function userDeletedHandler() {
    window.location = '/';
}

/*--------------Email------------*/

function sendEmailHandler() {
    console.log(this.responseText);
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
        console.log(user);
        let userDisplay = document.createElement('div');
        userDisplay.className = ('user');
        userDisplay.setAttribute('data-id', user.id);
        userDisplay.innerHTML = `

            <img src="https://picsum.photos/200" alt="User image" width="70px">
             <a href="/users/profile/${user.id}">${user.name}</a>`;

        body.appendChild(userDisplay);
    })
}

addEventListeners();
