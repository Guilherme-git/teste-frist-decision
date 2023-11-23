$(document).ready(function () {
    $.ajax({
        url: "../../src/List.php",
        method: 'GET',
        dataType: 'JSON',
        async: true,
    }).done(function (result) {
        if (result.data) {
            if (result.data) {
                for (var i = 0; i < result.data.length; i++) {
                    var row = `<tr>
                                        <td>${result.data[i].id}</td>
                                        <td>${result.data[i].name}</td>
                                        <td>${result.data[i].email}</td>
                                        <td>${result.data[i].password}</td>
                                        <td>
                                           <button type="button" class="btn btn-info btn_edit">Editar</button>
                                           <button type="button" class="btn btn-danger btn_remove">Remover</button>
                                        </td>
                                   </tr>`;

                    $("#tbody")[0].innerHTML += row
                }
            }
        }
    })

    $("#register").on('click', function (e) {
        e.preventDefault();

        const name = $("#name").val();
        const email = $("#email").val();
        const password = $("#password").val();
        const confirmPassword = $("#confirmPassword").val();

        const data = {
            name,
            email,
            password,
            confirmPassword
        }

        $.ajax({
            url: "../../src/Register.php",
            method: 'POST',
            data: data,
            dataType: "JSON"
        }).done(function (result) {
            if (result.error) {
                $("#success_register").attr("hidden", true);
                $("#success_register").html()

                $("#error_register").attr("hidden", false);
                $("#error_register").html(result.error)
                setTimeout(function () {
                    $("#error_register").attr("hidden", true);
                }, 5000);
            }

            if (result.success) {
                $("#error_register").attr("hidden", true);
                $("#error_register").html()

                $("#success_register").attr("hidden", false);
                $("#success_register").html(result.success)
                setTimeout(function () {
                    $("#success_register").attr("hidden", true);
                }, 5000);

                $("#id").val("");
                $("#name").val("");
                $("#email").val("");
                $("#password").val("");
                $("#confirmPassword").val("");
            }
        })

    });

});
