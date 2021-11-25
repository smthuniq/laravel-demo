(function(){

// to delay a request to server until we get a response
let commentsFilterIsLocked = false;

window.addEventListener('DOMContentLoaded', function () {
    let commentsForm = document.forms['comments-filter'],
        commentsFilter = commentsForm.elements['by-name'];

    commentsFilter.addEventListener('input', onCommentsFilterInput);
});


function onCommentsFilterInput(event) {
    let input = event.target,
        value = input.value;
    
    // delay a request to server until we get a response
    if (commentsFilterIsLocked) {
        return;
    }
    commentsFilterIsLocked = true;

    // make a request to server to find comments by a user name
    let xhr = new XMLHttpRequest(),
        url = null,
        errorMessage = 'Internal error. Please try later';

    if (value) {
        url = '/api/users/' + value + '/comments?user_id_type=name';
    } else {
        url = '/api/comments';
    }
    url = encodeURI(url);

    xhr.open('GET', url);
    xhr.responseType = 'json';
    xhr.send([
        'user_id_type' 
    ]);

    xhr.onload = function() {
        // If the last request to the server doesn't match a filter input,
        // it runs another request as the last one
        if (input.value !== value) {
            commentsFilterIsLocked = false;
            onCommentsFilterInput(event);
        }

        if ([200, 404].includes(xhr.status)) {
            rebuildCommentsBlock(xhr.response);
        } else {
            alert(errorMessage);
        }
        commentsFilterIsLocked = false;
    };
              
    xhr.onerror = function() {
        alert(errorMessage);
        commentsFilterIsLocked = false;
    };
}

function rebuildCommentsBlock(commentsData) {
    let currentCommentsIds = getShownCommentsIds(),
        newCommentsIds = [],
        commentsIdsToAdd = [],
        commentsIdsToDelete = [];

    // Find wich comments to show.
    // Add only comments that aren't shown
    newCommentsIds = commentsData.map(value => value.id);
    commentsIdsToAdd = newCommentsIds.filter(newCommentId => {
        return !currentCommentsIds.some(element => newCommentId == element);
    });

    // Find wich comments to hide.
    commentsIdsToDelete = currentCommentsIds.filter(currentCommentId => {
        return !newCommentsIds.some(element => currentCommentId == element)
    });
    if (commentsIdsToDelete.length) {
        deleteComments(commentsIdsToDelete);
    }

    // Retrieve data for comments to show.
    commentsData = commentsData.filter(commentData => {
        return commentsIdsToAdd.some(element => commentData.id == element);
    });
    // Show comments.
    commentsData.forEach(commentData => addComment(commentData));
}

function addComment(data) {
    let commentsBlock = document.querySelector('.comments'),
        comment = document.createElement('div'),
        author = document.createElement('span'),
        content = document.createElement('span');

    author.className = 'author';
    author.innerHTML = data.user.name + ' : :&nbsp;';
    content.className = 'content';
    content.textContent = data.content;

    comment.className = 'comment';
    comment.dataset.id = data.id;
    comment.append(author);
    comment.append(content);
    commentsBlock.append(comment);
}

/**
 * Which comments are shown now
 */
function getShownCommentsIds() {
    let comments = document.querySelectorAll('.comment'),
        commentsIds = [];
    comments.forEach(comment => commentsIds.push(comment.dataset.id));
    return commentsIds;
}

/**
 * Delete comments off HTML 
 */
function deleteComments($ids) {
    let selector = '.comment',
        comments = [];
    if ($ids) {
        selector = '';
        for (let id of $ids) {
            selector += `.comment[data-id="${id}"],`;
        }
        selector = selector.substr(0, selector.length - 1);
    }
    comments = document.querySelectorAll(selector);
    comments.forEach(comment => comment.remove());
}

})();