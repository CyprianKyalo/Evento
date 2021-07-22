<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evento | Landing</title>
    <link rel="stylesheet" href="../css1/styles.css" rel="stylesheet">

    <style type="text/css">

    </style>
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
            <img id="item-image" src="https://via.placeholder.com/500x200" alt="An image of the product or service">
            <figure class="user-description">
                <img src="https://via.placeholder.com/100" alt="owner's profile image" id="user-profile-image">
                <figcaption>@username</figcaption>
            </figure>
            <section id="item-description">
                <div class="description-container">
                    <ul class="description">
                        <li>Equipment: name</li>
                        <li>Decription: description of the equipment or service given by the owner.</li>
                        <li>Price & Rate: Ksh 25,000 per day/hour</li>
                    </ul>
                    <input class="description-buttons" type="button" value="Hire">
                    <input class="description-buttons" type="button" value="Buy" disabled>
                </div> 
            </section>
        </article>
    </main>
    <footer>
        <p>&copy2021 Evento, Inc.</p>
    </footer>
</body>
</html>