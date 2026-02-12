<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chicago Protected Bicycle Lanes</title>
  
    <!-- Bootstrap stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
    <!-- Boostrap script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </head>
  <body>

    <!-- The navbar is in its own isolated file, to make sure every page has the same navbar. -->
    <?php echo file_get_contents("./chunks/navbar"); ?>

    <section id="about">
      <div class="container-lg pt-3">
        <div class="row justify-content-center">
          <div class="col-md-10 col-lg-8"> <!--text-center text-md-start-->
            <div class="display-5 text-center py-3">About This Site</div>
            <p>
              Riding a bicycle is cost-effective, great for your health, and good for the environment. Not to mention, it can be a lot more fun than sitting in traffic. And bicycle advocates around the world agree that the only way to encourage the widespread adoption of bicycles as a means of transportation is to provide a <b>safe, robust network of protected bicycle lanes</b>. This protection can take many forms, from off-street cycling trails like the Lakefront Trail, to bollards delineating the edge of bicycle right-of-way, or even concrete barriers.
            </p>
            <p>
              The one thing that protected bicycle lanes are <i>not</i>, is paint. As many of us know, painted bicycle lanes without any additional traffic calming and protection on busy roads are not only uncomfortable to use, but flat-out dangerous. Traditional painted bicycle lanes put riders right next to speeding, angry drivers, as well as right in the middle of the "door zone", where they are at risk of being hit by someone opening their car door without looking. In fact, they can make the road even more dangerous for cyclists than no infrastructure at all, because the added road width gives drivers the ability to drive faster and more dangerously.
            </p>
            <p>
              In large, dense cities like Chicago, we need to support alternative ways of navigating the city that do not require cars. Chicago deserves a biking network that works for regular people, not just avid cyclists - all bodies, all ages, and all communities. Everyone should feel comfortable bringing their children, parents, and friends on a bicycle ride without worrying about their safety.
            </p>
            <div class="display-5 text-center py-3">This Map is a Starting Point</div>
            <p>
              As a city, we have a long way to go. The existing protected bicycle network is uneven. There are gaps. Until we have a complete safe cycling network that can serve the needs of all of our citizens, this map will be a work-in progress. It shows not only the work we have done, but the work that is still in progress, and the work we have yet to do.
            </p>
            <p>
              <b>This map is a tool for advocacy.</b> While the city provides an official map, which you can find at <a href="https://www.chicago.gov/city/en/sites/complete-streets-chicago/home/bike-program/existing-bike-network.html">https://www.chicago.gov/city/en/sites/complete-streets-chicago/home/bike-program/existing-bike-network.html</a>, they don't show the projects that are still underway. These projects need your support.
            </p>
            <p>
              This map will set out to document:
              <ul>
                <li>Every protected bicycle project that has been completed within the city of Chicago, shown in solid lines, including trails, on-street protected bike lanes, and greenways.</li>
                <li>Every protected bicycle project that is currently underway within the city of Chicago, shown in dotted lines, as well as status information and a link to sources with more information.</li>
              </ul>
            </p>
            <div class="display-5 text-center py-3">How To Use This Map</div>
            <p>
              We encourage you to find yourself on this map. Look at your neighborhood. Look at the places you like to go. Every dotted line is an effort that you can be supporting. And every gap is an effort waiting to happen.
            </p>
            <p>
              The fact is, the city of Chicago has a lot of work to do to make its roads safe for everyone. This map will reflect that.
            </p>
            <p>
              If you're curious, you can find a list of future bicycle lane projects here: <a href="https://www.chicago.gov/city/en/sites/complete-streets-chicago/home/bike-program/planned-bike-projects.html">https://www.chicago.gov/city/en/sites/complete-streets-chicago/home/bike-program/planned-bike-projects.html</a>. Much of our information comes from CDOT's public site, as well as from ward newsletters.
            </p>
            <p>
              Happy browsing, and please do not hesitate to reach out with any questions or corrections!
            </p>
          </div>
        </div>
      </div>
    </section>

  </body>
</html>
