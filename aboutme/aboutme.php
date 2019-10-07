<!DOCTYPE html>
<html lang="en">

<head>
    <title>All About Josh Hallinan</title>
    <meta charset="UTF-8" />
    <meta name="author" content="Josh Hallinan" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../general_style.css">
	<link rel="stylesheet" type="text/css" href="aboutme.css">
</head>

<body>
    <?php 
        $title = "All About Josh Hallinan";
        include '../templateHeader.php';
    ?>
    <section id="about_me">
        <h2 id="about"> About Me </h2>
        <img class="center" src="../images/josh.jpg" alt="Image of Josh over the summer" style="width:200px">
        <p class="big_first">Hello! I am a Junior at <abbr title="Colorado School of Mines">CSM</abbr>, and I currently reside in Lakewood, Colorado. I love to keep my self busy, so when I am not at school, I'm either working or enjoying some of my hobbies. My hobbies include:
        </p>
        <ul>
            <li>Running</li>
            <li>
                Playing music
                <ul>
                    <li>Saxophone</li>
                    <li>Clarinet</li>
                    <li>Trombone/Euphonium</li>
                </ul>
            </li>
            <li>Ultimate Frisbee</li>
            <li>Disc Golf</li>
            <li><del>Homework</del> (Just kidding!&#9786;)</li>
        </ul>
        <p>For the time being, I have been working during the school year as a lifeguard for the City of Lakewood Rec Centers, and I have just started teaching Marching Band at Lakewood High School. Both of my jobs have been extremely fun and very rewarding.
        </p>
        <p>Over the past two summers, I have performed with a <a href="https://en.wikipedia.org/wiki/Drum_and_bugle_corps_(modern)">Drum and Bugle Corps</a>. This year I marched with the
            <a href="https://en.wikipedia.org/wiki/Blue_Knights_Drum_and_Bugle_Corps">Blue Knights Drum and Bugle Corps</a>. We performed in 29 shows across the country, and got to play in front of tens of thousands of people (yes, that many people come to watch marching band!).
        </p>
        <table id="weekly_hours">
            <caption>Weekly Hours Spent on Activities</caption>
            <thead>
                <tr>
                    <th colspan="2" id="ac" scope="col">Activity</th>
                    <th id="h" scope="col">Hours</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th id="work" rowspan="2" headers="ac" scope="row">Work</th>
                    <td headers="ac work">Lifeguarding</td>
                    <td headers="h work">20</td>
                </tr>
                <tr>
                    <td headers="ac work">Teaching Band</td>
                    <td headers="h work">12</td>
                </tr>
                <tr>
                    <th id="leisure" rowspan="4" headers="ac" scope="row">Leisure</th>
                    <td headers="ac leisure">Spending time with friends</td>
                    <td headers="h leisure">6</td>
                </tr>
                <tr>
                    <td headers="ac leisure">Running/Working Out</td>
                    <td headers="h leisure">4</td>
                </tr>
                <tr>
                    <td headers="ac leisure">Practicing Music</td>
                    <td headers="h leisure">7</td>
                </tr>
                <tr>
                    <td headers="ac leisure">Disc Golf</td>
                    <td headers="h leisure">2</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2">Total</td>
                    <td>51</td>
                </tr>
            </tfoot>
        </table>
    </section>
    <hr>
    <section id="other_things">
        <h2 id="other">Other Things</h2>
        <article>
            <h3>Favorite Quote</h3>
            <blockquote cite="https://www.goodreads.com/quotes/tag/insightful"><q>Love is the will to extend one's self for the purpose of nurturing one's own or another's spiritual growth... Love is as love does. Love is an act of will -- namely, both an intention and an action. Will also implies choice. We do not have to love. We choose to love.</q> ― M. Scott Peck
            </blockquote>
        </article>
        <article>
            <h3> Music:</h3>
            <table id="favorite_music">
                <caption>Current Favorite Songs</caption>
                <thead>
                    <tr>
                        <th id="g">Genere</th>
                        <th id="ar">Artist</th>
                        <th id="f">Favorite Song</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td headers="g">Jazz</td>
                        <td headers="ar">Buddy Rich</td>
                        <td headers="f">Time Check</td>
                    </tr>
                    <tr>
                        <td headers="g">Pop</td>
                        <td headers="ar"> Childish Gambino</td>
                        <td headers="f">Feels Like Summer</td>
                    </tr>
                    <tr>
                        <td headers="g">Rock</td>
                        <td headers="ar">Imagine Dragons</td>
                        <td headers="f">Amsterdam</td>
                    </tr>
                </tbody>
            </table>
        </article>
        <article>
            <h3>Cool Code</h3>
            <code> rm -rf / </code>
            <br>
            <br>
            <strong>NOTE: Do not run this command on Linux!</strong>
            <p>This command tells the computer to remove all files and folders recursively starting at the root directory, which will wipe your system. This code is interesting to me because while it is a short, simple line of code, it demonstrates just how powerful the command terminal is.
            </p>
        </article>
    </section>
    <hr>
    <section class="contact">
        <h2 id="contact_me"> Contact Me</h2>
        <table id="my_schedule">
            <caption>Class Schedule</caption>
            <thead>
                <tr>
                    <th id="c">Course</th>
                    <th id="m">Meeting Date</th>
                    <th id="t">Time</th>
                    <th id="r">Room</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td headers="c">CSCI403</td>
                    <td headers="m">M W F</td>
                    <td headers="t">10:00 AM - 10:50 AM</td>
                    <td headers="r">
						<div class="tooltip">HH202<span class="tooltiptext">Hill Hall 202</span></div>
					</td>
                </tr>
                <tr>
                    <td headers="c">CSCI406</td>
                    <td headers="m">M W F</td>
                    <td headers="r">12:00 PM - 12:50 PM</td>
                    <td headers="t">
						<div class="tooltip">MZ126<span class="tooltiptext">Marquez Hall 126</span></div>
					</td>
                </tr>
                <tr>
                    <td headers="c">CSCI306</td>
                    <td headers="m">T TH</td>
                    <td headers="t">2:00 PM - 3:15 PM</td>
                    <td headers="r">
						<div class="tooltip">MZ022<span class="tooltiptext">Marquez Hall 022</span></div>
					</td>
                </tr>
                <tr>
                    <td headers="c">CSCI247</td>
                    <td headers="m">M W F</td>
                    <td headers="t">1:00 PM - 1:50 PM</td>
                    <td headers="r">
						<div class="tooltip">BB253<span class="tooltiptext">Brown Building 253</span></div>
					</td>
                </tr>
                <tr>
                    <td headers="c">CSCI445</td>
                    <td colspan="3" headers="m">---Online Course---</td>
                </tr>
            </tbody>
        </table>
        <p> email: <a href="mailto:jhallinan@mymail.mines.edu">jhallinan@mymail.mines.edu</a></p>
    </section>
    <?php include '../templateFooter.php';?>
</body>

</html>