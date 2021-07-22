<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento | Landing</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <ul>
            <li><a href="#">Logout</a></li>
        </ul>
    </header>
    <main>
        <aside>
            <img src="https://via.placeholder.com/150" alt="user profile" class="profile-img profile-aside-img">
            <ul id="aside-navigation">
                <li><a href="{{route('personal_details')}}" class="user-navigation">Profile</a></li>
                <li><a href="{{route('activity')}}" class="user-navigation">Activity</a></li>
                <li><a href="{{route('equipment')}}" class="user-navigation">Equipments</a></li>
                <li><a href="{{route('services')}}" class="user-navigation">Services</a></li>
            </ul>
        </aside>
        <article>
            <section id="item-equipment">
                <a href="{{route('description')}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span class="card-info-labels">Service:</span> name</li>
                            <li><span class="card-info-labels">Vendor:</span> username</li>
                        </ul>
                    </div>
                </a>
                <a href="{{route('description')}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span class="card-info-labels">Service:</span> name</li>
                            <li><span class="card-info-labels">Vendor:</span> username</li>
                        </ul>
                    </div>
                </a>
                <a href="{{route('description')}}" class="card-link">
                    <div class="card equipment">
                        <ul>
                            <li><span class="card-info-labels">Service:</span> name</li>
                            <li><span class="card-info-labels">Vendor:</span> username</li>
                        </ul>
                    </div>
                </a>
            </section>
        </article>
    </main>
    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>