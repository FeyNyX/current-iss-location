<div>
    <table>
        <tr>
            <td>Międzynarodowa Stacja Kosmiczna znajduje się nad: </td>
            <td id="iss_location_output"></td>
        </tr>
    </table>
</div>

<script type="text/javascript">
    var issLocationOutput = $('#iss_location_output');

    var iss = {
        issLatitude: null,
        issLongitude: null,
        issHumanizedData: null,
        updateIssData: function() {
            $.getJSON('https://api.wheretheiss.at/v1/satellites/25544', null, function(result) {
                iss.issLatitude = result.latitude;
                iss.issLongitude = result.longitude;
                iss.humanize();
            });
        },
        humanize: function() {
            $.ajax({
                url: '?controller=index&action=getISSLocation&no_layout=true',
                data: {
                    lat: iss.issLatitude,
                    lon: iss.issLongitude
                },
                success: function(result) {
                    iss.issHumanizedData = result;
                    iss.display();
                }
            });
        },
        display: function() {
            issLocationOutput.html(iss.issHumanizedData);
        }
    }

    $(function() {
        iss.updateIssData();
        setInterval(function() {
            iss.updateIssData();
        }, 10000);
    });
</script>
