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

    const form={
        el: false,
        data: false,
        init: function(){
            form.el = document.getElementById('form');
            form.attachEvents();
        },
        attachEvents: function(){
            form.el.addEventListener('submit', function(e){
                e.preventDefault();    //stop form from submitting
                var data = new FormData(form.el);
                data.append('id', form.data.id);

                console.log(form.data);

                var operation = form.data.id ? 'update' : 'insert';
                var url =  'user/' + operation;
                ajax.post(url, function(response){
                    message.info.show('Operación realizada con éxito','success');
                    if( operation == 'insert' ){
                        table.add(response);
                    }
                    else{
                        table.update(response);
                    }

                    fade.out(form.el.parentElement, function() {
                        fade.in(table.el.parentElement); 
                    });
                    form.data = false;
                }, data);
            });

            form.el.querySelectorAll('[type="button"]')[0].addEventListener('click', function(e){
                fade.out(form.el.parentElement, function() {
                    fade.in(table.el.parentElement); 
                });
            });
        },
        setData: function(o){
            form.data = o;
            form.el.querySelectorAll('[name="name"]')[0].value= o ? o.name : '';
            form.el.querySelectorAll('[name="last_name"]')[0].value= o ? o.last_name : '';
            form.el.querySelectorAll('[name="email"]')[0].value= o ? o.email : '';
            form.el.querySelectorAll('[name="password"]')[0].value= o ? o.password : '';
        }
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
                btnEdit.classList.add('blue');
                btnEdit.append('Editar');
                td.append(btnEdit);

                btnDelete = document.createElement('div');
                btnDelete.classList.add('btn');
                btnDelete.classList.add('delete');
                btnDelete.classList.add('red');
                btnDelete.append('Eliminar');
                td.append(btnDelete);
                
                tr.append(td);
            }
        },
        getItemById: function(id){
            for(var i=0; i< table.data.length; i++){
                if( table.data[i].id === id ){
                    return table.data[i];
                }
            }
        },
        attachEvents: function(){
            var btnAdd= document.getElementsByClassName('btn add')[0];
            btnAdd.addEventListener('click', function(e){
                form.setData(null);
                fade.out(table.el.parentElement, function() {
                    fade.in(form.el.parentElement); 
                });
            });

            document.querySelector('body').addEventListener('click', function(e) {
                if ( e.target.classList.contains('btn') ) {
                    if ( e.target.classList.contains('edit') ) {
                        form.setData( table.getItemById(e.target.parentElement.parentElement.getAttribute('data-id')) );
                        fade.out(table.el.parentElement, function() {
                            fade.in(form.el.parentElement); 
                        });
                    }
                    else if(e.target.classList.contains('delete')){

                        message.confirm.show(function(){
                            var data = new FormData(form.el);
                            var id= e.target.parentElement.parentElement.getAttribute('data-id');
                            data.append('id',  id);
                            ajax.post('user/delete', function(response){
                                table.delete(id);
                                fade.out(form.el.parentElement, function() {
                                    fade.in(table.el.parentElement); 
                                });
                            }, data);
                        });
                    }
                }
            }, true);
        },
        add: function(o){
            table.data.push(o);
            table.drawBody();
        },
        update: function(o){
            // TODOX test getItembyId
            for(var i=0; i< table.data.length; i++){
                if( table.data[i].id === o.id ){
                    table.data[i] = o;
                }
            }
            table.drawBody();
        },
        delete: function(o){
            console.log(o);
            var index = table.data.map(obj => obj.id).indexOf(o.id);
            table.data.splice(index, 1);
            table.drawBody();
        }
    }

    const message = {
        override:{
            el: false
        },
        confirm:{
            el: false,
            callback: false,
            init: function(){
                message.confirm.el = document.getElementById('message-confirm');
                message.confirm.attachEvents();
            },
            attachEvents: function(){
                var btnConfirm= message.confirm.el.getElementsByClassName('btn confirm')[0];
                btnConfirm.addEventListener('click', function(e){
                    message.confirm.callback();
                    message.confirm.hide();
                }); 
                var btnCancel= message.confirm.el.getElementsByClassName('btn cancel')[0];
                btnCancel.addEventListener('click', function(e){
                    message.confirm.hide();
                }); 
            },
            show: function(callback){
                message.confirm.callback = callback;
                message.confirm.el.style.display="block";
            },
            hide: function(){
                message.confirm.el.style.display="none";
            }
        },
        info: {
            el: false,
            init: function(){
                message.info.el = document.getElementById('message-info');
            },
            show: function(text, style){
                message.info.el.style.display="block";
                message.info.el.classList.add(style=='success' ? 'green' : 'red');
                message.info.el.classList.remove(style=='success' ? 'red' : 'green');
                message.info.el.getElementsByClassName('content')[0].innerHTML=text;
                var timeout = setTimeout(function(){ message.info.hide(); clearTimeout(timeout);  }, 2000);
            },
            hide: function(){
                message.info.el.style.display="none";
            }
        },
        init: function(){
            message.override.el = document.getElementById('override');
            message.confirm.init();
            message.info.init();
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
                setTimeout(fade,40);
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
                setTimeout(fade,40);
            }
        })();
       }
    }

    function init(){
        table.init();
        form.init();
        message.init();
    }


    init();

})();