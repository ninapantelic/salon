$("#btnDelete").click(function () {
  const selected = $("input[name=slct]:checked");
  request = $.ajax({
    url: "handler/delete.php",
    type: "post",
    data: { id: selected.val() },
  });

  request.done(function (res, textStatus, jqXHR) {
    if (res == "Success") {
      selected.closest("tr").remove();
      console.log("Appointment deleted!");
    } else {
      console.log("Appointment is not deleted!" + res);
    }
    console.log(res);
  });
});

$(".btn-edit").click(function () {
  const selected = $("input[name=slct]:checked");
  request = $.ajax({
    url: "handler/read.php",
    type: "post",
    dataType: "json",
    data: { id: selected.val() },
  });

  request.done(function (response, textStatus, jqXHR) {
    $("#name").val(response[0]["name"]);
    console.log(response[0]["name"]);

    $("#surname").val(response[0]["surname"].trim());
    console.log(response[0]["surname"].trim());

    $("#date").val(response[0]["date"].trim());
    console.log(response[0]["date"].trim());

    $("#service").val(response[0]["service"].trim());
    console.log(response[0]["service"].trim());

    $("#id").val(selected.val());

    console.log(response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Error occured " + textStatus, errorThrown);
  });
});

$("#editForm").submit(function (event) {
  event.preventDefault();
  const $form = $(this);
  const $entered = $form.find("input, select, button");
  const serijalization = $form.serialize();
  console.log(serijalization);
  $entered.prop("disabled", true);

  request = $.ajax({
    url: "handler/update.php",
    type: "post",
    data: serijalization,
  });

  request.done(function (response, textStatus, jqXHR) {
    if ((response = "Success")) {
      console.log("Appointment is successfully edited!");
      alert("Appointment is successfully edited!");
      location.reload(true);
      $("#editForm").reset;
    } else {
      console.log("Appointment unsuccessfully edited! " + response);
      alert("Appointment unsuccessfully edited!");
    }
    console.log(response);
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Error occured: " + textStatus, errorThrown);
  });

  $("#modalEditAppointment").modal("hide");
});
$("#addForm").submit(function (event) {
  event.preventDefault();

  const $form = $(this);
  const $enter = $form.find("input, select, button");

  const serialization = $form.serialize();
  console.log(serialization);

  $enter.prop("disabled", true);

  request = $.ajax({
    url: "handler/add.php",
    type: "post",
    data: serialization,
  });

  request.done(function (res, textStatus, jqXHR) {
    if (textStatus == "success") {
      alert("New appointment added!");
      location.reload(true);
    } else {
      console.error("The following error occurred: " + textStatus);
      alert("Your appointment is not added!");
    }
  });

  request.fail(function (jqXHR, textStatus, errorThrown) {
    console.error("Error> " + textStatus, errorThrown);
  });
});
$("#btnAdd").submit(function () {
  $("#modalAddAppointment").modal("toggle");
  return false;
});

$(".btnEdit").submit(function () {
  $("#modalEditAppointment").modal("toggle");
  return false;
});
$("#btnDel").submit(function () {
  $("#modalDeleteAppointment").modal("toggle");
  return false;
});
