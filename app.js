$(document).ready(function(){
    console.log("jQuery funcionando");
    let edit = false;
    fetchTask();
    $("#task-result").hide();
    $("#search").keyup(function(e){
        if ($("#search").val()){
            let search = $("#search").val();
            $.ajax({
                url: 'tasks-search.php',
                type: 'POST',
                data: { search:search },
                success: function(response){
                    console.log(response);
                    let tasks = JSON.parse(response);
                    let template = '';
                    tasks.forEach(task=>{
                        template +=`<li>
                            ${task.nombre}                    
                        </li>`
                    })
                    $("#container").html(template)
                    $("#task-result").show();
                }
            })
        }
    });

    $("#task-form").submit(function(e){
        const postData ={
            nombre:$('#nombre').val(),
            descripcion : $("#descripcion").val(),
            id:$('#taskIdEdit').val()
        };
        let url = edit === false ? 'create.php':'task-edit.php';
        $.post(url,postData,function(response){
            console.log(response);
            fetchTask();
            $("#task-form").trigger('reset')
        })
        e.preventDefault();
    });

    function fetchTask(){
        $.ajax({
            url: 'task-list.php',
            type: 'GET',
            success: function(response){
                let tasks = JSON.parse(response);
                let template = '';
                tasks.forEach(task =>{
                    template += `
                    <tr task-id=${task.id}>
                        <td >${task.id}</td>
                        <td><a href="#" class="task-item">${task.nombre}</a></td>
                        <td>${task.descripcion}</td>
                        <td><button class="btn btn-danger task-delete">Borrar</button></td>
                    </tr>`
                });
                $("#tasks").html(template);
            }
        })
    }

    $(document).on('click','.task-delete',function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('task-id');
        $.post('task-delete.php',{id},function(){
            fetchTask();
        })
    });

    $(document).on('click','.task-item',function(){
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('task-id');
        $.post('task-single.php',{id},function(response){
            const task = JSON.parse(response);
            $('#nombre').val(task.nombre);
            $('#descripcion').val(task.descripcion);
            $('#taskIdEdit').val(task.id);
            edit = true;
        })
    })
});