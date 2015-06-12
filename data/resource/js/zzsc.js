$(document).ready(function () {
    $('#pagination-demo').twbsPagination({
        totalPages: 10,
        visiblePages: 2,
		first:"首页",
		prev:"上一页",
		next:"下一页",
		last:"末页",
        version: '1.1',
		tagName:'AAA',
        onPageClick: function (event, page) {
         
			$.post("http://localhost/day44/1.php",{page:page},function(data){
				 $('#page-content').html('Page ' + data);
			});
        }
    });

    $('#navigation').affix({
        offset: {
            top: 200
        }
    });

    $('#pagination-demo-v1_0').twbsPagination({
        totalPages: 15,
        version: '1.0'
    });

    $('#pagination-demo-v1_1').twbsPagination({
        totalPages: 15,
        version: '1.1'
    });

    $('#visible-pages-example').twbsPagination({
        totalPages: 35,
        visiblePages: 10,
        version: '1.1'
    });

});

