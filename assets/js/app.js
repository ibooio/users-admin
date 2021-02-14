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


    function init(){
        table.init();
        form.init();
    }

    const form={
        el: false,
        actualId: false,
        init: function(){
            form.el = document.getElementById('form');
            form.attachEvents();
        },
        attachEvents: function(){
            form.el.addEventListener("submit", function(e){
                e.preventDefault();    //stop form from submitting
                var data = new FormData(form.el);
                data.append('id', form.actualId);

                var operation = form.actualId ? 'update' : 'insert';
                var url =  'user/' + operation;
                ajax.post(url, function(response){
                    console.log(response);
                    if( operation == 'insert' ){
                        table.add(response);
                    }
                    else{
                        table.update(response);
                    }

                    fade.out(form.el.parentElement, function() {
                        fade.in(table.el.parentElement); 
                    });
                    form.actualId = false;
                }, data);
            });
        },
    }


    const table={
        el: false,
        data: false,
        init: function(){
            table.el = document.getElementById('table');
            table.attachEvents();
            table.loadData();
        },
        loadData: function(){
            ajax.get("user/get_all", function(response){
                table.data = response;
                table.drawBody();
            }); 
        },        
        drawBody: function(){
            var tbody = document.querySelector('tbody');
            tbody.innerHTML = '';
            var tr=null, td = null, btnEdit = null, btnDelete=null;
            for(var i=0; i < table.data.length; i++){
                tr = document.createElement('tr'); 
                tr.setAttribute('data-id', table.data[i].id);
                tbody.append(tr);                

                td = document.createElement('td');
                td.append(table.data[i].name + ' ' + table.data[i].last_name);
                tr.append(td);

                td = document.createElement('td');
                td.append(table.data[i].email);
                tr.append(td);


                td = document.createElement('td');
                btnEdit = document.createElement('div');
                btnEdit.classList.add('btn');
                btnEdit.classList.add('edit');
                btnEdit.append('Editar');
                td.append(btnEdit);

                btnDelete = document.createElement('div');
                btnDelete.classList.add('btn');
                btnDelete.classList.add('delete');
                btnDelete.append('Eliminar');
                td.append(btnDelete);
                
                tr.append(td);
            }
        },
        attachEvents: function(){
            var btnAdd= document.getElementsByClassName('btn add')[0];
            btnAdd.addEventListener('click', function(e){
                fade.out(table.el.parentElement, function() {
                    fade.in(form.el.parentElement); 
                });
            });

            document.querySelector('body').addEventListener('click', function(e) {
                if ( e.target.classList.contains('btn') ) {
                    if ( e.target.classList.contains('edit') ) {
                        form.actualId = e.target.parentElement.parentElement.getAttribute('data-id');
                        fade.out(table.el.parentElement, function() {
                            fade.in(form.el.parentElement); 
                        });
                    }
                    else{

                        var data = new FormData(form.el);
                        var id= e.target.parentElement.parentElement.getAttribute('data-id');
                        data.append('id',  id);
                        ajax.post('user/delete', function(response){
                            table.delete(id);
                            fade.out(form.el.parentElement, function() {
                                fade.in(table.el.parentElement); 
                            });
                            form.actualId = false;
                        }, data);

                    }
                }
            }, true);
        },
        add: function(o){
            table.data.push(o);
            table.drawBody();
        },
        update: function(o){
            for(var i=0; i< table.data.length; i++){
                if( table.data[i].id === o.id ){
                    table.data[i] = o;
                }
            }
            table.drawBody();
        },
        delete: function(o){
            var index = table.data.map(obj => obj.id).indexOf(o.id);
            table.data.splice(index, 1);
            table.drawBody();
        }
    }

    var fade = {
       in: function(el){
        var s= el.style;
        s.display="block";
        s.opacity=0;
        (function fade(){
            s.opacity = Number(s.opacity) + 0.1;
            if( Number(s.opacity) > 1 ){
                //callback();
            }
            else{
                setTimeout(fade,80);
            }
        })();
       },
       out: function(el, callback){
        var s= el.style;
        s.opacity=1;
        (function fade(){
            s.opacity -=.1;

            if( s.opacity < 0 ){
                s.display="none";
                callback();
            }
            else{
                setTimeout(fade,80);
            }
        })();
       }
    }

    init();

})();