@extends('layouts.master')

@section('title')
    Staff
@endsection

@section('content')
    <span class="border border-light" style="background-color:#F0F0F0">
    <div class="container">
        &nbsp;
        <h2>Staff</h2>
        &nbsp;
    </div>
</span>
    <br>

    <div class="container">
        <div class="block-heading-two">
            <h4>
                Air Traffic Manager -
                @if($atm == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($atm as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:atm@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Air Traffic Manager is the Chief Executive and in charge of all oversight and administration of the ARTCC.
               The ATM’s duties and responsibilities include, but are not limited to the following:
               <ol>
                   <li>Reports to the North Eastern Region Director (VATUSA9)</li>
                   <li>Responsible for all operations associated with the Washington D.C. ARTCC.</li>
                   <li>Maintains an online presence on the VATSIM server.</li>
                   <li>Attends periodic meetings to report on ARTCC activities.</li>
                   <li>Establishes an ARTCC web page and oversees its maintenance.</li>
                   <li>Initiates, obtains Air Traffic Director approval for, and maintains ARTCC Standard Operating Procedures.</li>
                   <li>Provides for coordination of position assignments and position restrictions when necessary.</li>
                   <li>Provides guidance and help to assigned controllers or guests. Optionally, establishes a staff of "Mentors" to assist controllers.</li>
                   <li>Establishes an Deputy Air Traffic Manager position and defines the duties of that position.</li>
                   <li>Recommends disciplinary actions to the region Air Traffic Director.</li>
                   <li>Establishes “assistant” positions for any ARTCC administrative position as required</li>
               </ol>
            </p>

        </div>
        <hr>
        <div class="block-heading-two">
            <h4>
                Deputy Air Traffic Manager -
                @if($datm == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($datm as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:datm@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Deputy Air Traffic Manager is second in command of the oversight and administration of the ARTCC.
               The DATM’s duties and responsibilities include, but are not limited to the following:
               <ol>
                   <li>Reports to the ATM</li>
                   <li>Monitors the day-to-day activities of the ARTCC. </li>
                   <li>Assists in the development and execution of ARTCC projects.</li>
                   <li>Maintains an online presence on the VATSIM server.</li>
                   <li>Functions as ARTCC senior staff member. Attends periodic meetings to report on ARTCC activities.</li>
                   <li>Assists in coordination of position assignments and position restrictions when necessary.</li>
                   <li>Assumes the duties of the ATM when he is unavailable.</li>
                   <li>Any other duty assigned by the ATM</li>
               </ol>
            </p>
        </div>
        <hr>
        <div class="block-heading-two">
            <h4>
                Training Administrator -
                @if($ta == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($ta as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:ta@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Training Administrator is responsible for overseeing the development of Training Procedures and Instructor/Mentor
               core of the facility. Duties include, but are not limited to the following:
               <ol>
                   <li>Reports to the ATM</li>
                   <li>Responsible for the quality of the staff instructors and mentors.</li>
                   <li>Oversees and administers the ARTCC training program.</li>
                   <li>Develops and implements training-related material and projects.</li>
                   <li>Works in conjunction with the Facilities Engineer to develop and maintain ARTCC SOP's, LOA's and the ARTCC Training Policy.</li>
                   <li>Ensures that ARTCC instructor positions are adequately staffed. Recruits new instructors and recommends appointments to the
                       ARTCC ATM and the VATUSA Training Department in accordance with VATUSA 3120.311.</li>
                   <li>Works with instructors and mentors to develop their knowledge and to ensure that training standards are being uniformly applied
                       to all students.</li>
                   <li>Tracks the progress of student controllers, including testing, promotions, and recurrent and remedial instruction.</li>
                   <li>Manages and leads the Training Division of ZDC.</li>
                   <li>Appoints Assistant Training Administrator (ATA), if desired, to assist in TA duties with the exclusion of appointing instructors.
                       The ATA must be approved by the ATM.</li>
               </ol>
            </p>
        </div>
        <hr>
        @if($ata != '[]')
            <div class="block-heading-two">
                <h4>
                    Assistant Training Administrator -
                    @if($ata == '[]')
                        <i>Vacant</i>
                    @else
                        @foreach($ata as $s)
                            {{ $s->full_name }}
                        @endforeach
                    @endif
                </h4>
            </div>
            <hr>
        @endif
        <div class="block-heading-two">
            <h4>
                Webmaster -
                @if($wm == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($wm as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:wm@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Webmaster is responsible for the development and maintenance of the ARTCC website and associated files. 
               <ol>
                   <li>Reports to the DATM.</li>
                   <li>Maintains, updates, and manages ARTCC website.</li>
                   <li>Technical advisor to the ATM</li>
                   <li>Ensures database and website source code is backed-up as required.</li>
                   <li>Any other duties assigned by the DATM</li>
               </ol>
            </p>
        </div>
        <hr>
        @if($awm != '[]')
            <div class="block-heading-two">
                <h4>
                    Assistant Webmaster -
                    @if($awm == '[]')
                        <i>Vacant</i>
                    @else
                        @foreach($awm as $s)
                            {{ $s->full_name }}
                        @endforeach
                    @endif
                </h4>
            </div>
            <hr>
        @endif
        <div class="block-heading-two">
            <h4>
                Events Coordinator -
                @if($ec == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($ec as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:ec@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Events Coordinator is responsible for the planning, scheduling, and execution of events at the ARTCC.
               Duties include, but are not limited to, the following:
               <ol>
                   <li>Reports to the DATM.</li>
                   <li>Identifies and develops events to generate traffic and promote the ARTCC.</li>
                   <li>Implements and oversees approved events.</li>
                   <li>Coordinates with neighboring ARTCC to arrange support for ZDC hosted events and neighboring events.</li>
                   <li>Develops and distributes marketing materials to promote events and the ARTCC</li>
                   <li>Appoints Assistant Events Coordinator (AEC), if desired, to assist in EC duties. Must be approved by the ATM.</li>
               </ol>
            </p>
        </div>
        <hr>
        @if($aec != '[]')
            <div class="block-heading-two">
                <h4>
                    Assistant Events Coordinator -
                    @if($aec == '[]')
                        <i>Vacant</i>
                    @else
                        @foreach($aec as $s)
                            {{ $s->full_name }}
                        @endforeach
                    @endif
                </h4>
            </div>
            <hr>
        @endif
        <div class="block-heading-two">
            <h4>
                Facility Engineer -
                @if($fe == '[]')
                    <i>Vacant</i>
                @else
                    @foreach($fe as $s)
                        {{ $s->full_name }}
                    @endforeach
                @endif
                &nbsp;<a href="mailto:fe@vzdc.org" style="color:black"><i class="fa fa-envelope"></i></a>
            </h4>
            <p>The Facility Engineer is responsible for the development and maintenance of the following technical resources for the ARTCC:
               <ol>
                   <li>Reports to the DATM.</li>
                   <li>Maintains and updates VRC sector files, vSTARS files, vERAM files, and vATIS files.</li>
                   <li>Maintains and updates, in cooperation with the TA, SOPs and LOAs. </li>
                   <li>Manages ZDC facility resources.</li>
               </ol>
            </p>
        </div>
        <hr>
        @if($afe != '[]')
            <div class="block-heading-two">
                <h4>
                    Assistant Facility Engineer -
                    @if($afe == '[]')
                        <i>Vacant</i>
                    @else
                        @foreach($afe as $s)
                            {{ $s->full_name }}
                        @endforeach
                    @endif
                </h4>
            </div>
            <hr>
        @endif
        <div class="block-heading-two">
            <h4>
                Instructors:
                @if($ins == '[]')
                    <i>&nbsp;No Instructors</i>
                @else
                    <br><br>
                    <ul>
                        @foreach($ins as $i)
                            <li>{{ $i->full_name }}</li>
                        @endforeach
                    </ul>
                @endif
                <hr>
                Mentors:
                @if($mtr == '[]')
                    <i>&nbsp;No Mentors</i>
                @else
                    <br><br>
                    <ul>
                        @foreach($mtr as $i)
                            <li>{{ $i->full_name }}</li>
                        @endforeach
                    </ul>
                @endif
            </h4>
        </div>
    </div>

@endsection
