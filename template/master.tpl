<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>{{title}}</title>
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>

  <div class="container-fluid">
    {{h1}}
    <ul class="list-group">
      <li class="list-group-item">{{file}}</li>
      <li class="list-group-item">{{url}}</li>
      <li class="list-group-item">{{date}}</li>
    </ul>
    <div class="user-card-cont">
      {{content}}
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.5.17/dist/vue.js"></script>
</body>

</html>
