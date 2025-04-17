$(document).ready(function () {
    $('#TableBlog').DataTable({
       processing: true,
       serverSide: true,
       paging:false,
       info: false,
       searching:false,
        order: [[1, 'asc']],
        ajax: {
            url: 'index.php?action=showStatisticsArticle',
            type: 'POST'
        },
        columns: [
            { data: 'id',
                visible:false,
                orderable: false
            },
            { data: 'datecreation'  },
            { data: 'title'  },
            { data: 'nbvues'  },
            { data: 'qteCommentaires'  },
            {data: 'details'    }
        ],
        columnDefs: [
            { width: "50px", targets: 0 },
            { width: "140px", targets: 1 },
            { width: "380px", targets: 2 },
            { width: "50px", targets: 3 },
            { width: "50px", targets: 4 },
            {
                width: "100px",
                targets: 5,
                orderable: false,
                render:function(data, type, row) {
                    var id = row.id; // Supposons que l'ID est dans la 1ère colonne
                    return '<a href="details.php?id=' + id + '" class="comment-btn">Voir</a>';
                }
            },
            { targets: [3], className: 'dt-center' },
            { targets: [4], className: 'dt-center' },
            { targets: [5], className: 'dt-center' },
       ],
       scrollX: true
    });

    $('#TableBlog tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected').siblings().removeClass('selected');
    });
});