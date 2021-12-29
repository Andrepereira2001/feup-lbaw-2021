function addEventListeners() {
    let itemCheckers = document.querySelectorAll('article.card li.item input[type=checkbox]');
    [].forEach.call(itemCheckers, function(checker) {
        checker.addEventListener('change', sendItemUpdateRequest);
    });

    let itemCreators = document.querySelectorAll('article.card form.new_item');
    [].forEach.call(itemCreators, function(creator) {
        creator.addEventListener('submit', sendCreateItemRequest);
    });

    let itemDeleters = document.querySelectorAll('article.card li a.delete');
    [].forEach.call(itemDeleters, function(deleter) {
        deleter.addEventListener('click', sendDeleteItemRequest);
    });

    let cardDeleters = document.querySelectorAll('article.card header a.delete');
    [].forEach.call(cardDeleters, function(deleter) {
        deleter.addEventListener('click', sendDeleteCardRequest);
    });

    let cardCreator = document.querySelector('article.card form.new_card');
    if (cardCreator != null)
        cardCreator.addEventListener('submit', sendCreateCardRequest);

    /*----Apenas interessa apartir daqui ---*/

    /*--------------project------------*/

    let projectDeleters = document.querySelectorAll('article.project header a.delete');
    [].forEach.call(projectDeleters, function(deleter) {
        deleter.addEventListener('click', sendDeleteProjectRequest);
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

    /*--------------task------------*/

    let taskCreator = document.querySelector('#task-create form.create');
    if (taskCreator != null)
        taskCreator.addEventListener('submit', sendCreateTaskRequest);

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

function sendDeleteProjectRequest(event) {
    let id = this.closest('article').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/projects/' + id, null, projectDeletedHandler);
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
    console.log("cheguei");

    let id = this.closest('section').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let color = this.querySelector('input[name=color]').value;

    if (name != '')
        sendAjaxRequest('post', '/projects/' + id + '/edit', { name, description, color }, projectEditHandler);

    event.preventDefault();
}

/*--------------Task------------*/

function sendCreateTaskRequest(event) {
    event.preventDefault();
    let projectId = this.querySelector('input[name=project-id]').value;
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let priority = this.querySelector('input[name=priority]').value;

    if (name != '')
        sendAjaxRequest('post', '/tasks', { name, description, priority, projectId }, taskAddedHandler);

    event.preventDefault();
}

function sendEditTaskRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let name = this.querySelector('input[name=name]').value;
    let description = this.querySelector('input[name=description]').value;
    let priority = this.querySelector('input[name=priority]').value;

    if (name != '')
        sendAjaxRequest('post', '/tasks/' + id + '/edit', { name, description, priority }, taskEditHandler);

}

function sendCompleteTaskRequest(event) {
    event.preventDefault();

    let id = this.closest('section').getAttribute('data-id');
    let day = new Date().toISOString().slice(0, 10);
    let time = new Date().toISOString().slice(10, 19);
    const today = day + time;
    console.log(today);

    if (id != undefined) //change route
        sendAjaxRequest('post', '/tasks/' + id, { today }, taskEditHandler);

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
    }
    else {
        this.querySelector('#error').style.display = "flex";
    }
}

/* HANDLERS */

/*--------------Project------------*/

function projectDeletedHandler() {
    if (this.status != 200) window.location = '/';
    let project = JSON.parse(this.responseText);
    let article = document.querySelector('article.project[data-id="' + project.id + '"]');
    article.remove();
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

/*--------------Task------------*/

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

/*--------------User------------*/

function userEditHandler() {
    const user = JSON.parse(this.responseText);
    if (this.status === 200) {
        window.location = '/users/profile/' + user.id;
    } else if (this.status !== 201) {
        window.location = '/';
    }
}

/*Acho que nao interessa APARTIR DAQUI */
function createItem(item) {
    let new_item = document.createElement('li');
    new_item.classList.add('item');
    new_item.setAttribute('data-id', item.id);
    new_item.innerHTML = `
  <label>
    <input type="checkbox"> <span>${item.description}</span><a href="#" class="delete">&#10761;</a>
  </label>
  `;

    new_item.querySelector('input').addEventListener('change', sendItemUpdateRequest);
    new_item.querySelector('a.delete').addEventListener('click', sendDeleteItemRequest);

    return new_item;
}

// function projectAddedHandler() {
//     if (this.status != 200) {
//       window.location = '/';
//     }
//     let proj = JSON.parse(this.responseText);

//     // Create the new card
//     let new_proj = createProject(proj);

//     // Reset the new card input
//     let form = document.querySelector('article.project form.new_project');
//     form.querySelector('[type=text]').value="";

//    // Insert the new card
//     let article = form.parentElement;
//     let section = article.parentElement;
//     section.insertBefore(new_proj, article);

//     // Focus on adding an item to the new card
//     new_proj.querySelector('[type=text]').focus();
// }

/* NAO INTERESSA */

function itemUpdatedHandler() {
    let item = JSON.parse(this.responseText);
    let element = document.querySelector('li.item[data-id="' + item.id + '"]');
    let input = element.querySelector('input[type=checkbox]');
    element.checked = item.done == "true";
}

function itemAddedHandler() {
    if (this.status != 200) window.location = '/';
    let item = JSON.parse(this.responseText);

    // Create the new item
    let new_item = createItem(item);

    // Insert the new item
    let card = document.querySelector('article.card[data-id="' + item.card_id + '"]');
    let form = card.querySelector('form.new_item');
    form.previousElementSibling.append(new_item);

    // Reset the new item form
    form.querySelector('[type=text]').value = "";
}

function itemDeletedHandler() {
    if (this.status != 200) window.location = '/';
    let item = JSON.parse(this.responseText);
    let element = document.querySelector('li.item[data-id="' + item.id + '"]');
    element.remove();
}

function cardDeletedHandler() {
    if (this.status != 200) window.location = '/';
    let card = JSON.parse(this.responseText);
    let article = document.querySelector('article.card[data-id="' + card.id + '"]');
    article.remove();
}

function cardAddedHandler() {
    if (this.status != 200) window.location = '/';
    let card = JSON.parse(this.responseText);

    // Create the new card
    let new_card = createCard(card);

    // Reset the new card input
    let form = document.querySelector('article.card form.new_card');
    form.querySelector('[type=text]').value = "";

    // Insert the new card
    let article = form.parentElement;
    let section = article.parentElement;
    section.insertBefore(new_card, article);

    // Focus on adding an item to the new card
    new_card.querySelector('[type=text]').focus();
}

function createCard(card) {
    let new_card = document.createElement('article');
    new_card.classList.add('card');
    new_card.setAttribute('data-id', card.id);
    new_card.innerHTML = `

  <header>
    <h2><a href="cards/${card.id}">${card.name}</a></h2>
    <a href="#" class="delete">&#10761;</a>
  </header>
  <ul></ul>
  <form class="new_item">
    <input name="description" type="text">
  </form>`;

    let creator = new_card.querySelector('form.new_item');
    creator.addEventListener('submit', sendCreateItemRequest);

    let deleter = new_card.querySelector('header a.delete');
    deleter.addEventListener('click', sendDeleteCardRequest);

    return new_card;
}

function sendItemUpdateRequest() {
    let item = this.closest('li.item');
    let id = item.getAttribute('data-id');
    let checked = item.querySelector('input[type=checkbox]').checked;

    sendAjaxRequest('post', '/api/item/' + id, { done: checked }, itemUpdatedHandler);
}

function sendDeleteItemRequest() {
    let id = this.closest('li.item').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/item/' + id, null, itemDeletedHandler);
}

function sendCreateItemRequest(event) {
    let id = this.closest('article').getAttribute('data-id');
    let description = this.querySelector('input[name=description]').value;

    if (description != '')
        sendAjaxRequest('put', '/api/cards/' + id, { description: description }, itemAddedHandler);

    event.preventDefault();
}

function sendDeleteCardRequest(event) {
    let id = this.closest('article').getAttribute('data-id');

    sendAjaxRequest('delete', '/api/cards/' + id, null, cardDeletedHandler);
}

function sendCreateCardRequest(event) {
    let name = this.querySelector('input[name=name]').value;

    if (name != '')
        sendAjaxRequest('put', '/api/cards/', { name: name }, cardAddedHandler);

    event.preventDefault();
}


addEventListeners();