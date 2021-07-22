@foreach ($all_comment as $comment)
    @foreach ($all_rating as $rating)
        @if ($comment->customer_id == $rating->customer_id && $comment->product_id == $rating->product_id && $comment->created_at == $rating->created_at)
            <li class="review">
                <div class="comment-container">
                    <div class="row">
                        <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">
                            <div class="content_info_customer">
                                {{-- <p class="comment-in"><span class="post-name"> --}}
                                @foreach ($customers as $customer)
                                    @if ($comment->customer_id == $customer->customer_id)
                                        @foreach ($customer_info as $info)
                                            @if ($info->customer_id == $customer->customer_id)
                                                <img src="{{ asset('public/upload/' . $info->customer_avt) }}"
                                                    style="width: 60px; height: 60px; border-radius: 50%" alt="">
                                            @endif
                                        @endforeach

                                        <div class="content-name-rating">
                                            <p class="comment-in"><span class="post-name"
                                                    style="font-size: 17px">{{ $customer->username }}</span></p>
                                            <div class="rating">
                                                <p class="star-rating">
                                                    @php
                                                        $convert_persen = 0;
                                                    @endphp
                                                    @if ($rating->rating_level == 1)
                                                        @php
                                                            $convert_persen = 20;
                                                        @endphp
                                                    @elseif($rating->rating_level == 2)
                                                        @php
                                                            $convert_persen = 40;
                                                        @endphp
                                                    @elseif($rating->rating_level == 3)
                                                        @php
                                                            $convert_persen = 60;
                                                        @endphp
                                                    @elseif($rating->rating_level == 4)
                                                        @php
                                                            $convert_persen = 80;
                                                        @endphp
                                                    @elseif($rating->rating_level == 5)
                                                        @php
                                                            $convert_persen = 100;
                                                        @endphp
                                                    @endif
                                                    <span class="width-{{ $convert_persen }}percent"></span>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                                <span
                                    class="post-date date-comment">{{ date('d/m/Y H:i a', strtotime($comment->created_at)) }}</span>
                                {{-- </p> --}}
                            </div>

                            <p class="author place_order" style="margin-left: 70px"><i class="fa fa-check-circle"
                                    style="color: #7faf51"></i> đã mua tại <b class="brand_mku">MKU_FOOD</b></p>
                            <p class="comment-text comment_message" style="font-size: 15px">
                                {{ $comment->comment_message }}</p>
                        </div>
                        <div class="comment-review-form col-lg-3 col-lg-offset-1 col-md-3 col-sm-4 col-xs-12">
                            <span class="title">Was this review helpful?</span>
                            <ul class="actions">
                                <li><a href="#" class="btn-act like" data-type="like"><i class="fa fa-thumbs-up"
                                            aria-hidden="true"></i>Yes
                                        (100)</a></li>
                                {{-- <li><a href="#" class="btn-act hate" data-type="dislike"><i
                                                                                            class="fa fa-thumbs-down" aria-hidden="true"></i>No
                                                                                        (20)</a></li>
                                                                                <li><a href="#" class="btn-act report" data-type="dislike"><i
                                                                                            class="fa fa-flag" aria-hidden="true"></i>Report</a>
                                                                                </li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
            </li>
        @endif
    @endforeach
@endforeach
