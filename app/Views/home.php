<?php
use App\Controllers\HomeController;
$title = 'software-dev';
$controller = new HomeController();
$staffers = $controller->getAllStaffers();
$movies = $controller->getAllMovies();
$roles = $controller->getAllRoles();


if($_POST){    
    if (isset($_POST['staffer']) && (!empty($_POST['name']) && !empty($_POST['employeeID']))){  
        $controller->userForm($_POST);
    }
    if (isset($_POST['movie']) && (!empty($_POST['name'])
        && !empty($_POST['production_start_date'])
        && !empty($_POST['production_end_date'])
        && !empty($_POST['release_date'])
        && !empty($_POST['generated_income']))){
        $controller->movieForm($_POST);
    }
    if (isset($_POST['role']) && (!empty($_POST['name'])
        && !empty($_POST['fixe_income'])
        && !empty($_POST['percentage']))){
           
        $controller->roleForm($_POST);
    }

    if (isset($_POST['affectation']) && (!empty($_POST['employeeID'])
        && !empty($_POST['nameMovie'])
        && !empty($_POST['nameRole']))){
        $controller->affectationForm($_POST);
    }

    if (isset($_POST['salary']) && (!empty($_POST['salary_date'])
        && !empty($_POST['employeeID']))){
          $amount = $controller->calculAmount($_POST);
    }

    if ( isset($_POST['stafferDelete'])){
        $controller->deleteStaff($_POST['stafferDelete']);
    }

    if ( isset($_POST['movieDelete'])){
        $controller->deleteMovie($_POST['movieDelete']);
    }

    if ( isset($_POST['roleDelete'])){
        $controller->deleteRole($_POST['roleDelete']);
    }
} 
?>

<h1 class="text-center"> Software exercice development </h1>
<br/><br/>
<hr>
<br/><br/>
<h2> Step 1 : creation movie</h2>
<form class="row g-3" method="POST" action="" id="movie">
<input type="hidden" name="movie" >
  <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="name" placeholder="Enter percentage">
        <label for="floatingInput">Name of the movie</label>
  </div>
  <div class="col-auto">
    <label for="startDate" class="form-label">Production start date</label>
    <input type="date" id="startDate" class="form-control" name="production_start_date">
  </div>
  <div class="col-auto">
    <label for="endDate" class="form-label">Production end date</label>
    <input type="date" id="endDate" class="form-control" name="production_end_date">
  </div>
  <div class="col-auto">
    <label for="releaseDate" class="form-label">Release Date</label>
    <input type="date" id="releaseDate" class="form-control" name="release_date">
  </div>
  <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="generated_income" placeholder="Enter percentage">
        <label for="floatingInput">expected generated revenue</label>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary">Creation Movie</button>
  </div>
</form>
<hr>
<br/><br/>

<h2> Step 2 : choose fixe income and percentage for a role</h2>
<form class="row g-3" method="POST" action="">
<input type="hidden" name="role">
  <div class="col-auto">
        <select class="form-select" aria-label="Default select example" name="name">
            <option value="1">Actor</option>
            <option value="2">Production Staff</option>
            <option value="3">Production Staff Senior</option>
        </select>
  </div>
    <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="fixe_income" placeholder="Enter fix income">
        <label for="floatingInput">Enter fixe income by day(£)</label>
    </div>
    <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="percentage" placeholder="Enter percentage">
        <label for="floatingInput">Enter percentage (%)</label>
    </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Update Role</button>
  </div>
</form>
<hr>
<br/><br/>
<h2> Step 3 : affect an employeeID to a role and a movie</h2>
<?php if(!is_null($movies) && !is_null($roles)): ?>
<form class="row g-3" method="POST" action="">
<input type="hidden" name="affectation">
    <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="employeeID" placeholder="employeeID">
        <label for="floatingInput">Employee ID</label>
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-info">PLAY IN</button>        
    </div>
    <div class="col-auto">
        <select class="form-select" aria-label="Default select example" name="nameMovie">
            <?php foreach($movies as $movie): ?>
            <option value="<?= $movie->id; ?>"><?= $movie->name; ?></option>
            <?php endforeach; ?>
        </select>
  </div>
  <div class="col-auto">
        <button type="button" class="btn btn-info">WITH THE ROLE</button>        
  </div>
  <div class="col-auto">
        <select class="form-select" aria-label="Default select example" name="nameRole">
            <option value="1">Actor</option>
            <option value="2">Production Staff</option>
            <option value="3">Production Staff Senior</option>
        </select>
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Affectation</button>
  </div>
</form>
<?php else: ?>
<p>You need to create staffer , movies and roles in order to display this part </p>
<?php endif; ?>
<hr>
<br/><br/>
<h2> Final step : Find out the amount earn by the employee for a year and a month</h2>
<?php if(!is_null($movies) && !is_null($roles)): ?>
<form class="row g-3" method="POST" action="">
<input type="hidden" name="salary">
    <div class="col-auto">
        <button type="button" class="btn btn-info">CALCUL FOR THIS DATE :</button>        
    </div>
    <div class="col-auto">
        <input type="date" id="salaryDate" class="form-control" name="salary_date">
    </div>
    <div class="col-auto">
        <button type="button" class="btn btn-info">THE SALARY OF THIS EMPLOYEE:</button>        
    </div>
    <div class="form-floating mb-3 col-auto">
        <input type="text" class="form-control" id="floatingInput" name="employeeID" placeholder="employeeID">
        <label for="floatingInput">employee ID</label>
    </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">CALCUL</button>
  </div>
</form>
<div class="col-auto">
    <button type="button" class="btn btn-info">THE SALARY IS: </button>
    <span>£<?=  (isset($amount)) ?  $amount : ''; ?> for this month</span>
</div>
<?php else: ?>
<p>You need to create staffer , movies and roles in order to display this part </p>
<?php endif; ?>
<hr>
<br/><br/>
<table class="table caption-top">
<caption>EMPLOYEES</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Employee ID</th>
      <th scope="col">Played in</th>
      <th scope="col">Like</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!is_null($staffers)): ?>
  <?php foreach($staffers as $staffer): ?>
  <?php if(!is_null($staffer->employeeID)): ?>
    <tr>
      <th scope="row"><?= $staffer->id; ?></th>
      <td><?= $staffer->employeeID; ?></td>
      <td><?= $staffer->name; ?></td>
      <td>
          <?php if($staffer->role_id == 1 ): ?>
          <?= 'actor'; ?>
          <?php elseif($staffer->role_id == 2 ): ?>
            <?= 'Production staff'; ?>
          <?php else: ?>
            <?= 'Production staff'; ?>
          <?php endif; ?>         
      </td>
        <td>
            <form method='POST' action="">
                <input type="hidden" name="stafferDelete" value="<?= $staffer->id; ?>" />
                <button type="submit" data-id="<?= $staffer->id; ?>" 
                        class="alert alert-danger">Delete</button>
            </form>  
        </td>          
    </tr>
  <?php endif; ?>
    <?php endforeach; ?>
    <?php else: ?>
    <td>
        <p>No employee for the moment</p>
    </td>
    <?php endif; ?>
  </tbody>
</table>

<table class="table caption-top">
<caption>MOVIES</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Production start date</th>
      <th scope="col">Production end date</th>
      <th scope="col">Release Date</th>
      <th scope="col">Expected generated revenue</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!is_null($movies)):  ?>
  <?php foreach($movies as $movie): ?>
    <tr>
      <th scope="row"><?= $movie->id; ?></th>
      <td><?= $movie->name; ?></td>
      <td><?= date("d-m-Y",strtotime($movie->production_start_date)); ?></td>
      <td><?= date("d-m-Y",strtotime($movie->production_end_date)); ?></td>
      <td><?= date("d-m-Y",strtotime($movie->release_date)); ?></td>
      <td><?= $movie->generated_income; ?></td>
        <td>
            <form method='POST' action="">
                <input type="hidden" name="movieDelete" value="<?= $movie->id; ?>" />
                <button type="submit" data-id="<?= $movie->id; ?>" 
                        class="alert alert-danger">Delete</button>
            </form>            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <td>
        <p>No movie for the moment</p>
    </td>
    <?php endif; ?>
  </tbody>
</table>

<table class="table caption-top">
<caption>ROLES</caption>
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Fixe Income</th>
      <th scope="col">Percentage</th>
    </tr>
  </thead>
  <tbody>
  <?php if(!is_null($roles)):  ?>
  <?php foreach($roles as $role): ?>
    <tr>
      <th scope="row"><?= $role->id; ?></th>
      <td><?php 
               switch($role->name){
                   case "1":
                        echo 'actor';
                        break;
                    case "2":
                        echo "staff production";
                        break;
                    case "3";
                    echo "staff production senior";
                        break;
               }
            ?>
        </td>
      <td><?= $role->fixe_income; ?></td>
      <td><?= $role->percentage; ?></td>
    </tr>
    <?php endforeach; ?>
    <?php else: ?>
    <td>
        <p>No movie for the moment</p>
    </td>
    <?php endif; ?>
  </tbody>
</table>

<?php ob_start(); ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<?php $pageJavascripts = ob_get_clean(); ?>
