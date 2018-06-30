
<div class="list-group ">
    <a href="home.php" class="list-group-item mainNav" id="hom">
        <span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Home </span></a>
        <a href="staff.php" id="stuff" class="list-group-item">
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span> Employees </a>
            <a  id="payHist" class="list-group-item  mainNav">
                <span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span> Payment</a>
                <a href="#" id="regc" class="list-group-item  mainNav">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Register Clerk </a>
                    <a href="#" id="pay" class="list-group-item  mainNav">
                        <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Payroll </a>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle list-group-item glyphicon glyphicon-user mainNav" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> Profile
                             <span class="caret"></span></button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="contact.php"   id="con">Contact Info</a></li>
                                <li><a href="account.php"  id="acc">Account Info</a></li>
                            </ul>
                        </div>
                        <a href="stats.php" id="st" class="list-group-item mainNav"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Reports </a>
                        <a href="#" id="inbox" class="list-group-item mainNav">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> Messages </a>
                        </div>

                        <div class="well">
                            <ul class="list-group">
                                <br> <span class="glyphicon glyphicon-flag"></span> <a class="btn-danger">Trush</a><br><br>
                                <span class="glyphicon glyphicon-flag"></span><a href="">Specialization</a><br><br>
                                <span class="glyphicon glyphicon-flag"></span> <a href="">Managing Your Acc</a><br><br>
                                <span class="glyphicon glyphicon-flag"></span> <a href="">FAQ</a><br><br>
                                <span class="glyphicon glyphicon-flag"></span> <a href="">How to Earn more </a><br><br>
                                <span id="lg" class="glyphicon glyphicon-flag" aria-hidden="true"></span><a href="#">Change Password</a>
                            </ul>
                        </div>
                        <script>
        var navs = document.querySelectorAll('.mainNav')
        navs.forEach(function(nav) {
            nav.addEventListener('click', function(e) {
                if (this.getAttribute('id') !== 'hom')
                    navs.forEach(function(na) {
                        na.classList.remove('main-color-bg', 'active')
                    })

                    this.classList.add('main-color-bg');
                })
        })
                        </script>