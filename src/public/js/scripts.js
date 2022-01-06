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
    let user_id = event.target.getAttribute('data-id');;
    let project_id = this.closest('section').getAttribute('data-id');

    console.log("deleting", user_id,project_id);

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', {user_id}, participationDeletedHandler);
    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', {user_id}, null);
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

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', {user_id}, projectRemoveMemberHandler);
}

function projectRemoveCoordinatorRequest(event) {
    event.preventDefault();

    let user_id = event.target.getAttribute('data-id');
    let project_id = this.closest('section').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + project_id + '/decreaseParticipation', {user_id}, projectRemoveCoordinatorHandler);
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

    console.log(user, id, userId);
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

    sendAjaxRequest('post', '/tasks/' + task_id + '/edit', {id_user}, taskRemoveMemberHandler);
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
    let email = this.querySelector('input[name=email]').value;
    let message = this.querySelector('textarea[name=message').value;
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
    if(this.status == 406){
        alert("Last coordinator! Can't leave project.")
    }else if(this.status == 200){
        window.location = '/users';
    }
    else{
        alert("Error: Can't leave project");
    }
}

function projectDeletedHandler() {
    if(this.status == 200){
        window.location = '/users';
    }
    else{
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
    console.log(user.image_path);
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

function taskRemoveMemberHandler(){
    if (this.status != 200) window.location = '/users';
    let user = JSON.parse(this.responseText);

    let member = document.querySelector('#task-edit .assigned .user[data-id="' + user.id + '"]');
    member.remove();
}

function projectRemoveCoordinatorHandler(){
    if(this.status === 406){
        alert("Last coordinator! Can't leave project.")
    }else if(this.status !== 200){
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
        console.log(user);
        let userDisplay = document.createElement('div');
        userDisplay.className = ('user');
        userDisplay.setAttribute('data-id', user.id);
                    // if(user.image_path !== "./img/default"){
    //     console.log("entrie");
    //     userDisplay.innerHTML = `

    //     <img src="{{asset(./img/andre.png)}}" alt="User image" width="70px" class="profilePhoto">
    //     <a href="/users/${user.id}/profile">${user.name}</a>`;
    // }
    // else{
        userDisplay.innerHTML = `
        <span class="profilePhoto"></span>
        <a href="/users/${user.id}/profile">${user.name}</a>`;
    //}

        // userDisplay.innerHTML = `

        //     <img src="https://picsum.photos/200" alt="User image" width="70px">
        //      <a href="/users/${user.id}/profile">${user.name}</a>`;

        body.appendChild(userDisplay);
    })
}

addEventListeners();

