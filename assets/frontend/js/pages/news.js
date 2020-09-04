function htmlEntities(str) {
	return String(str)
		.replace(/&/g, "&amp;")
		.replace(/</g, "&lt;")
		.replace(/>/g, "&gt;")
		.replace(/"/g, "&quot;");
}
$(document).ready(function () {
	$("#search").on("submit", function (e) {
		e.preventDefault();
		loadPagination(0);
	});
	// Detect pagination click
	$("#pagination").on("click", "a", function (e) {
		e.preventDefault();
		var pageno = $(this).attr("data-ci-pagination-page");
		loadPagination(pageno);
	});

	loadPagination(0);
	loadCategory();
});

// Load pagination
function loadPagination(pagno) {
	$.ajax({
		url: `${base_url}frontend/news/loadRecord/${pagno}`,
		type: "POST",
		dataType: "json",
		data: {
			saerchText: $("#searchText").val(),
		},
		success: function (response) {
			$("#pagination").html(response.pagination);
			createNewsList(response.result, response.row);
		},
	});
}
// Load pagination by tag
function loadPaginationByTag(pagno, tag) {
	if (curTag != tag) {
		curTag = tag;
	} else {
		curTag = "";
	}
	$.ajax({
		url: `${base_url}news/loadRecord/${pagno}`,
		type: "POST",
		dataType: "json",
		data: {
			saerchText: $("#searchText").val(),
			tag: curTag,
		},
		success: function (response) {
			$("#pagination").html(response.pagination);
			createNewsList(response.result, response.row);
			loadCategory();
		},
	});
}
// load category
function loadCategory() {
	$.ajax({
		url: base_url + "gis/tagsWithCount/",
		type: "POST",
		dataType: "json",
		data: {},
		success: function (response) {
			createCategoryList(response);
		},
	});
}

// create category list
function createCategoryList(result) {
	$("#tagList").empty();
	for (index in result) {
		var count = index;
		var list = `<a href="javascript:;" onclick="loadPaginationByTag(0,'${index}')">
                                <large>
                                    ${index}
                                </large>
                                <small>
                                    (${result[index]})
                                </small>
                                <br>
                            </a>`;
		$("#tagList").append(list);
	}
}

// Create table list
function createNewsList(result, sno) {
	sno = Number(sno);
	$("#newsList").empty();
	for (index in result) {
		var id = result[index].news_id;
		var userId = result[index].user_id;
		var title = htmlEntities(result[index].news_title);
		var slug = result[index].news_slug;
		var content = result[index].news_body;
		var imgName = result[index].ud_img_name;
		var full_name = result[index].ud_full_name;
		var createdDate = result[index].news_created_date;
		// var isClosed = result[index].news_is_closed;
		// var category = htmlEntities(result[index].news_category);
		// var school = htmlEntities(result[index].school_name);
		var imgSrc = "";
		var btn = "";
		var btnEdit = "";
		var btnDelete = "";
		var btnClose = "";
		var btnOpen = "";
		var elem = document.createElement("div");
		elem.style.display = "none";
		document.body.appendChild(elem);
		elem.innerHTML = content;
		try {
			imgSrc = elem.querySelector("img").src;
		} catch (e) {
			imgSrc = `${base_url}assets/dist/img/default-image.png`;
		}
		btn = btnEdit + btnDelete + btnClose + btnOpen;
		if (!imgName) {
			imgName = "avatar2.png";
		}
		content = content.substr(0, 30);
		// var link = result[index].link;
		sno += 1;
		var list = ` <div class="col-md-6 col-sm-12">
                     <div class="full">
                        <div class="blog_section">
                            <div class="blog_feature_img"> <img class="img-responsive" style="max-height:200px;" src="${imgSrc}" alt="#"> </div>
                            <div class="blog_feature_cantant">
                                <p class="blog_head">${title}</p>
                                <div class="post_info">
                                    <ul>
                                        <li><i class="fa fa-user" aria-hidden="true"></i> ${full_name}</li>
                                        <li><i class="fa fa-calendar" aria-hidden="true"></i> ${createdDate}</li>
                                    </ul>
                                </div>
                                ${content}
                                <div class="bottom_info">
                                    <div class="pull-left"><a class="btn sqaure_bt" href="${base_url}news/view/${id}/${slug}">Read More<i class="fa fa-angle-right"></i></a></div>
                                    <div class="pull-right">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
		$("#newsList").append(list);
	}
}
