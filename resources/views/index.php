<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ assets('css/style.css') }}">
</head>

<body>
  <div class="container">
    <div class="m-auto flex justify-center mt-2">
      <table class="table-fixed">
        <thead class=" bg-pink-300  hover:bg-pink-200">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Password</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody id="allUserData">
        </tbody>
      </table>
    </div>
  </div>
  <button onClick="showData()" class="bg-red-100 p-10 rounded border border-yellow-400 border-spacing-2">show Data</button>
  <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
  <script>
    function showData() {
      $.ajax({
        type: "GET",
        url: "<?= _WEB_ROOT ?>home/showData",
        data: "",
        success: function(response) {
          response = $.parseJSON(response);
          var data = response[0].data;
          var tableUser = "";
          data.forEach((e) => {
            tableUser +=
              "<tr>" +
              "<th>" + e.id + "</th>" +
              "<th>" + e.name + "</th>" +
              "<th>" + e.email + "</th>" +
              "<th>" + e.age + "</th>" +
              "<th>" + e.password + "</th>" +
              "<th>" +
              "<a href='{{ route('home.detail', 2) }}' class='p-3 bg-blue-500 rounded-xl'>Detail</a>" +
              "<a href='' class='p-3 bg-blue-500 mx-1 rounded-xl'>Edit</a>" +
              "<button class='p-3 bg-blue-500 rounded-xl'>Delete</button>" +
              "</th>" +
              "</tr>";
            $("#allUserData").html(tableUser);
          })
        }
      });
    }
  </script>
</body>

</html>