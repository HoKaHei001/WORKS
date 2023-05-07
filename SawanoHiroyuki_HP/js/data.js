var defaultComments = []

var commentsData = defaultComments
if (localStorage && localStorage.getItem('comments')) {
    commentsData = JSON.parse(localStorage.getItem('comments'));
} else {
    commentsData = defaultComments;
    localStorage.setItem('comments', JSON.stringify(defaultComments));
}