var input = document.getElementById('cover');
var infoArea = document.getElementById('file-upload-filename');

input.addEventListener('change', showFileName);

function showFileName(event) {
    // the change event gives us the input it occurred in 
    var input = event.srcElement;

    if (input.files.length == 0) {
        // if fileName is empty
        infoArea.textContent = '';
    } else {
        // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
        var fileName = input.files[0].name;

        // use fileName however fits your app best, i.e. add it into a div
        infoArea.textContent = fileName;
    }
}