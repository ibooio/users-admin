(function() {

    var ajax = {
        get: function(url, callback, data){
            var xmlhttp = new XMLHttpRequest();
    
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) { 
                    callback.apply(this,[JSON.parse(xmlhttp.responseText)]);
                }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();
        },
        post: function(url, callback, data){
            var xmlhttp = new XMLHttpRequest();
    
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == XMLHttpRequest.DONE && xmlhttp.status == 200) { 
                    callback.apply(this,[JSON.parse(xmlhttp.responseText)]);
                }
            };
            xmlhttp.open("POST", url, true);
            xmlhttp.send(data);
        }
    }

    function test(data){
        console.log('GET RESULT', data);
    }

    function test2(data){
        console.log('POST RESULT', data);
    }

    ajax.get("user/get_all", test);
    function init(){
        var form = document.querySelector("#edit");
        form.addEventListener("submit", function(e){
            e.preventDefault();    //stop form from submitting
            var data = new FormData(form);
            ajax.post("user/insert", test2, data);
        });
    }

    init();

})();
