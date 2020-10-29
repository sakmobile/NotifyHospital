$(document).ready(function () {







    $("#s_p").click(function (event) {
        event.preventDefault();
        var option_search = $('#option_search').val();
        var date_s = $('#date_s').val();
        var date_e = $('#date_e').val();

        $.ajax({
            url: "./Home/get_reportall",
            type: "POST",
            data: {
                search_d: option_search,
                date_ss: date_s,
                date_ee: date_e

            },
            cache: false,
            success: function (datas) {

                const data = jQuery.parseJSON(datas);
                var text = data[0].device_name;
                document.getElementById("title_s").innerHTML = text;
                const all_rooms = [...new Set(data.map(x => x.room_name))]
                const colors = ["#E57373", "#F06292", "#BA68C8", "#9575CD", "#1976D2", "#388E3C"]
                const datasets = all_rooms.map((r, i) => {
                    return {
                        label: r,
                        backgroundColor: colors[all_rooms.indexOf(r)],
                        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                    }
                })

                data.forEach(x => {
                    const roomIndex = all_rooms.findIndex(r => x.room_name == r)
                    const monthIndex = Number(x.date.split('-')[1]) - 1
                    datasets[roomIndex].data[monthIndex] += 1
                })

                var ctx = document.getElementById("myChart");
                var mybarChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        datasets
                    },

                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }
                });



            }


            // }

        });

    })



});

function bar() {
    var ctx = document.getElementById("myChart");
    var mybarChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: room,
                backgroundColor: "#26B99A",
                data: [5, 14, 12, 27, 25, 20, 12, 22, 9, 6, 2, 5]
            }, {
                label: 'ห้อง2',
                backgroundColor: "##0000FF",
                data: [6, 10, 15, 6, 22, 20, 39, 5, 9, 12, 22, 4]
            }, {
                label: 'ห้อง3',
                backgroundColor: "#DAF7A6",
                data: [9, 11, 19, 22, 27, 6, 4, 7, 42, 14, 21, 6]
            }, {
                label: 'ห้อง4',
                backgroundColor: "#FF33CC",
                data: [4, 10, 11, 23, 26, 22, 35, 45, 48, 2, 6, 3]
            }, {
                label: 'ห้อง5',
                backgroundColor: "#0277BD",
                data: [1, 10, 7, 5, 6, 2, 24, 44, 9, 8, 5, 30]
            }, {
                label: 'ห้อง6',
                backgroundColor: "#FF5733",
                data: [5, 14, 12, 20, 2, 40, 3, 41, 5, 50, 1, 11]
            }
            ]
        },

        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });


}