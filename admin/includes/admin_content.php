<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin content
                <small>Subheading</small>

            </h1>
            <?php
                // $user = new User();

                // $user->username = "pikachu";
                // $user->password = "123456";
                // $user->first_name = "muscular";
                // $user->last_name = "pikachu";

                // $user->create();

                // $user = User::find_user_by_id(3);

                // $user->last_name = "Pikchu";

                // $user->update();

                // $user = User::find_user_by_id(1);
                // $user->username = "Hank";

                $user = new User();
                $user->username = "Edwin";

                $user->save();
            ?>
           


            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->