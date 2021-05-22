define([], function() {

    return {
        init: function() {
            document.querySelector('#downloadButton').addEventListener('click', function() {
                console.log('clicked !');
            })
        }
    };
});