@extends('backend.layouts.app')

@section('title', __('Dashboard'))

@section('content')
    <!-- Body: Body -->
                                             


       
                        <h3 class="fw-bold mb-0">Reviews</h3>
                        <div class="col-auto d-flex">
                            <div class="dropdown px-2">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Sort By
                                </button>
                                <button class="lea" onclick="openReviewBox()">Write a Review</button>
                                <ul class="dropdown-menu  dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                                    <li><a class="dropdown-item" href="#">Most Recent</a></li>
                                    <li><a class="dropdown-item" href="#">Positive First</a></li>
                                    <li><a class="dropdown-item" href="#">Negative First</a></li>
                                </ul>
                            </div>
                    
            </div> <!-- Row end  -->
            
          
                                            <div class="card-body">
                                                <h2 class=" display-6 fw-bold mb-0">4.5</h2>
                                                <small class="text-muted">based on 1,032 ratings</small>
                                                <div class="d-flex align-items-center">
                                                    <span class="mb-2 me-3">
                                                        <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                        <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                        <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                        <a href="#" class="rating-link active"><i class="bi bi-star-fill text-warning"></i></a>
                                                        <a href="#" class="rating-link active"><i class="bi bi-star-half text-warning"></i></a>
                                                    </span>
                                                </div>
                                                <div class="progress-count mt-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <h6 class="mb-0 fw-bold d-flex align-items-center">5<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                        <span class="small text-muted">661</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar light-success-bg" role="progressbar" style="width: 92%" aria-valuenow="92" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-count mt-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <h6 class="mb-0 fw-bold d-flex align-items-center">4<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                        <span class="small text-muted">237</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar bg-info-light" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-count mt-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <h6 class="mb-0 fw-bold d-flex align-items-center">3<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                        <span class="small text-muted">76</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar bg-lightyellow" role="progressbar" style="width: 40%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-count mt-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <h6 class="mb-0 fw-bold d-flex align-items-center">2<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                        <span class="small text-muted">19</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar light-danger-bg " role="progressbar" style="width: 15%" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-count mt-2">
                                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                                        <h6 class="mb-0 fw-bold d-flex align-items-center">1<i class="bi bi-star-fill text-warning ms-1 small-11 pb-1"></i></h6>
                                                        <span class="small text-muted">39</span>
                                                    </div>
                                                    <div class="progress" style="height: 10px;">
                                                        <div class="progress-bar bg-careys-pink" role="progressbar" style="width: 10%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                               <br><br>
 
                                                <!DOCTYPE html>
                                                <html lang="en">
                                                <head>
                                                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

                                                    <meta charset="UTF-8">
                                                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                                                    <title>Review Box</title>
                                                    <style>
                                                        /* Add your custom styles here */
                                                        .stars {
                                                            display: flex;
                                                            flex-direction: row-reverse;
                                                            cursor: pointer;
                                                        }
                                                        .star {
                                                            font-size: 24px;
                                                            justify-content: right;
                                                        }
                                                        .review-box{
                                                            margin-top: 20px;
                                                            border-style: none;
                                                            padding: 10px;
                                                            border-radius: 10px;
                                                            background-color: #fff; /* Set the background color of the box */
            border: 1px solid #ccc; /* Add a border to the box */
            box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.3);
                                                            
                                                        }
                                                        @media (max-width: 600px) {
    .reply-box {
        width: 100%; /* Set the width to 100% for smaller screens */
       /* Remove the left margin for smaller screens */
        margin-left: 0px;
    }
}
                                                        .reply-box {
                                                            box-shadow:  midnightblue 5px 2px 5px;
            
            padding: 10px;
            margin-top: 10px;
           
            background-color: #f9f9f9; /* Set background color */
            border-radius: 5px; /* Add rounded corners */
            width: 300px;
        }
                                                        .lea {
                background-color: midnightblue;
                color: white;
                border-style: none;
                border-color: none;
                padding: 10px;
                border-radius: 3px;
            }
            .input-area {
                background-color: #ddd;
            }
    
            .lable {
                color: black;
                font-weight: 800;
            }
    
            input,
            textarea,
            #status {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
                box-sizing: border-box;
                border: 1px solid #ccc;
                border-radius: 4px;
            }
    .like{
        background-color: #4caf50; 
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
            /* Green */
    }
    .dlt1{
        background-color: #f44336; /* Red */
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
    }
    .edit1{
        background-color: goldenrod; /* Red */
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
    }
    .reply1{
        background-color: midnightblue; /* Red */
            display: inline-block;
            padding: 5px 10px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out, color 0.3s ease-in-out;
            border: none;
            border-radius: 5px;
            color: #ddd;
    }
                                                    </style>
                                                </head>
                                                <body>
                                                
                                               
                                                
                                                <div id="reviewBox" style="display: none;">
                                                    <div class="stars" onclick="setRating(event)">
                                                        <span class="star" data-value="5">&#9733;</span>
                                                        <span class="star" data-value="4">&#9733;</span>
                                                        <span class="star" data-value="3">&#9733;</span>
                                                        <span class="star" data-value="2">&#9733;</span>
                                                        <span class="star" data-value="1">&#9733;</span>
                                                    </div>
                                                    <input type="text" placeholder="Your Name" id="reviewerName" />
                                                    <textarea id="reviewText" placeholder="Write your review..."></textarea>
                                                    <button class="lea" onclick="sendReview()">Send Review</button>
                                                </div>
                                                
                                                <div id="reviewsContainer"></div>
                                                
                                                <script>
                                                    let currentRating = 0;
                                                
                                                    function openReviewBox() {
                                                        document.getElementById('reviewBox').style.display = 'block';
                                                    }
                                                
                                                    function setRating(event) {
                                                        if (event.target.classList.contains('star')) {
                                                            const rating = parseInt(event.target.getAttribute('data-value'));
                                                            currentRating = rating;
                                                            highlightStars();
                                                        }
                                                    }
                                                
                                                    function highlightStars() {
                                                        const stars = document.querySelectorAll('.star');
                                                        stars.forEach(star => {
                                                            const value = parseInt(star.getAttribute('data-value'));
                                                            star.style.color = value <= currentRating ? 'gold' : 'black';
                                                        });
                                                    }
                                                
                                                    function sendReview() {
                                                        const reviewText = document.querySelector('#reviewText').value;
                                                        const reviewerName = document.querySelector('#reviewerName').value;
                                                
                                                        if (!reviewText || !reviewerName) {
                                                            alert('Please enter your name and a review before sending.');
                                                            return;
                                                        }
                                                
                                                        const review = {
                                                            rating: currentRating,
                                                            reviewer: reviewerName,
                                                            comment: reviewText,
                                                            timestamp: new Date().toLocaleString(),
                                                            replies: [],
                                                            likes: 0
                                                        };
                                                
                                                        // Retrieve existing reviews from local storage
                                                        const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];
                                                
                                                        // Add the new review
                                                        existingReviews.push(review);
                                                
                                                        // Store the updated reviews back to local storage
                                                        localStorage.setItem('reviews', JSON.stringify(existingReviews));
                                                
                                                        // Display the reviews
                                                        displayReviews();
                                                
                                                        // Clear the review text, name, and reset the rating
                                                        document.querySelector('#reviewText').value = '';
                                                        document.querySelector('#reviewerName').value = '';
                                                        currentRating = 0;
                                                        highlightStars();
                                                
                                                        // Hide the review box after submitting
                                                        document.getElementById('reviewBox').style.display = 'none';
                                                    }
                                                
                                                    function displayReviews() {
                                                        const reviewsContainer = document.querySelector('#reviewsContainer');
                                                        reviewsContainer.innerHTML = '';
                                                
                                                        const reviews = JSON.parse(localStorage.getItem('reviews')) || [];
                                                
                                                        reviews.forEach((review, index) => {
                                                            const reviewBox = document.createElement('div');
                                                            reviewBox.classList.add('review-box');
                                                            reviewBox.innerHTML = `
                                                                <p><strong>Rating:</strong> ${getStarsHTML(review.rating)}</p>
                                                                <p><strong>Reviewer:</strong> ${review.reviewer}</p>
                                                                <p><strong>Comment:</strong> ${review.comment}</p>
                                                                <p><strong>Timestamp:</strong> ${review.timestamp}</p>
                                                                <p><strong>Likes:</strong> ${review.likes} <button class="like" onclick="likeReview('${review.timestamp}')">  <i class="fas fa-thumbs-up"></i>Like</button></p>
                                                                <button class="edit1"onclick="editReview('${review.timestamp}')">Edit Review</button>
                                                                <button class="reply1"onclick="replyReview('${review.timestamp}')">Reply</button>
                                                                <button class="dlt1"onclick="deleteReview('${review.timestamp}')">Delete Review</button>
                                                            `;
                                                            function getStarsHTML(rating) {
    let starsHTML = '';
    for (let i = 1; i <= 5; i++) {
        const starColor = i <= rating ? 'gold' : 'black';
        starsHTML += `<span style="color: ${starColor}; font-size: 28px;">&#9733;</span>`; // Filled or empty star with increased font size
    }
    return starsHTML;
}

                                                            // Display replies if available
                                                            if (review.replies && review.replies.length > 0) {
                                                                review.replies.forEach(reply => {
                                                                    const replyBox = document.createElement('div');
                                                                    replyBox.classList.add('reply-box');
                                                                    replyBox.innerHTML = `
                                                                        <p><strong>Admin:</strong> ${reply}</p>
                                                                    `;
                                                                    reviewBox.appendChild(replyBox);
                                                                });
                                                            }
                                                
                                                            reviewsContainer.appendChild(reviewBox);
                                                        });
                                                    }
                                                
                                                    function getStarsHTML(rating) {
                                                        let starsHTML = '';
                                                        for (let i = 1; i <= 5; i++) {
                                                            starsHTML += i <= rating ? '&#9733;' : '&#9734;'; // Filled or empty star
                                                        }
                                                        return starsHTML;
                                                    }
                                                
                                                    function replyReview(timestamp) {
                                                        const replyMessage = prompt('Enter your reply:');
                                                        if (replyMessage !== null) {
                                                            // Retrieve existing reviews from local storage
                                                            const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];
                                                
                                                            // Find the review to reply to
                                                            const reviewToReply = existingReviews.find(r => r.timestamp === timestamp);
                                                
                                                            if (reviewToReply) {
                                                                // Add the reply to the review
                                                                reviewToReply.replies = reviewToReply.replies || [];
                                                                reviewToReply.replies.push(replyMessage);
                                                
                                                                // Store the updated reviews back to local storage
                                                                localStorage.setItem('reviews', JSON.stringify(existingReviews));
                                                
                                                                // Display the reviews with the new reply
                                                                displayReviews();
                                                            }
                                                        }
                                                    }
                                                
                                                    function editReview(timestamp) {
    // Retrieve existing reviews from local storage
    const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];

    // Find the index of the review to edit
    const indexToEdit = existingReviews.findIndex(r => r.timestamp === timestamp);

    if (indexToEdit !== -1) {
        // Display the review to edit in the review box
        const reviewToEdit = existingReviews[indexToEdit];
        document.querySelector('#reviewerName').value = reviewToEdit.reviewer;
        document.querySelector('#reviewText').value = reviewToEdit.comment;

        // Disable the "Send Review" button during edit mode
        const sendReviewBtn = document.querySelector('button[onclick="sendReview()"]');
        sendReviewBtn.innerText = 'Update Review';
        sendReviewBtn.onclick = function () {
            updateReview(timestamp);
        };
        document.getElementById('reviewBox').style.display = 'block';
    }
}

function updateReview(timestamp) {
    // Retrieve existing reviews from local storage
    const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];

    // Find the index of the review to update
    const indexToUpdate = existingReviews.findIndex(r => r.timestamp === timestamp);

    if (indexToUpdate !== -1) {
        // Update the existing review with edited content
        existingReviews[indexToUpdate].reviewer = document.querySelector('#reviewerName').value;
        existingReviews[indexToUpdate].comment = document.querySelector('#reviewText').value;

        // Store the updated reviews back to local storage
        localStorage.setItem('reviews', JSON.stringify(existingReviews));

        // Display the reviews with the updated one
        displayReviews();

        // Reset the "Send Review" button to its original state
        const sendReviewBtn = document.querySelector('button[onclick="sendReview()"]');
        sendReviewBtn.innerText = 'Send Review';
        sendReviewBtn.onclick = function () {
            sendReview();
        };

        // Clear the review text, name, and reset the rating
        document.querySelector('#reviewText').value = '';
        document.querySelector('#reviewerName').value = '';
        document.querySelector('#imageUpload').value = '';
        currentRating = 0;
        highlightStars();

        // Hide the review box after updating
        document.getElementById('reviewBox').style.display = 'none';
    }
}


                                                                                        
                                                    function deleteReview(timestamp) {
                                                        const confirmDelete = confirm('Are you sure you want to delete this review?');
                                                        if (confirmDelete) {
                                                            // Retrieve existing reviews from local storage
                                                            const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];
                                                
                                                            // Filter out the review to delete
                                                            const updatedReviews = existingReviews.filter(r => r.timestamp !== timestamp);
                                                
                                                            // Store the updated reviews back to local storage
                                                            localStorage.setItem('reviews', JSON.stringify(updatedReviews));
                                                
                                                            // Display the reviews without the deleted one
                                                            displayReviews();
                                                        }
                                                    }
                                                
                                                    function likeReview(timestamp) {
                                                        // Retrieve existing reviews from local storage
                                                        const existingReviews = JSON.parse(localStorage.getItem('reviews')) || [];
                                                
                                                        // Find the review to like
                                                        const reviewToLike = existingReviews.find(r => r.timestamp === timestamp);
                                                
                                                        if (reviewToLike) {
                                                            // Increment the likes count
                                                            reviewToLike.likes = (reviewToLike.likes || 0) + 1;
                                                
                                                            // Store the updated reviews back to local storage
                                                            localStorage.setItem('reviews', JSON.stringify(existingReviews));
                                                
                                                            // Display the reviews with the updated likes count
                                                            displayReviews();
                                                        }
                                                    }
                                                
                                                    // Display existing reviews on page load
                                                    displayReviews();
                                                
                                                </script>
                                                
                                                </body>
                                                </html>
                                                
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

    <script src="{{ asset('js/template.js') }}"></script>
@endsection
