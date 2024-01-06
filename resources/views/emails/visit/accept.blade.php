@extends('layouts.email')
@section('content')
    <p>Dear {!! $visitor->name !!},</p>

    <p>Congratulations! You have been accepted as a visitor in Washington DC ARTCC.</p>
    <p>You can find all the information for the various facilities within the ARTCC website under the files page, <a href="http://www.vzdc.org">www.vzdc.org</a>.</p>
    <p>Teamspeak 3 is used for all controller communications.</p>
    <p>Upon acceptance to vZDC as a Visiting Controller, you will be assigned the Getting Started course for vZDC found in the VATUSA Academy under Washington ARTCC Courses. This course provides a quick overview of the resources needed to control vZDC. You will be permitted to control any vZDC facilities not designated as Tier 1 or Tier 2, up to your current rating, upon being approved as a visitor.</p>
    <p>Visiting controllers seeking endorsement at Tier 1 and Tier 2 facilities will schedule the appropriate type of training session following completion of the Getting Started course. Visiting controllers will follow the training path for Tier 1 endorsement for the type of facility endorsement sought (i.e. for Tier 1 ground positions, follow the Stage 1, Block 2 training footprint). For visiting controllers seeking Tier 1 endorsements at Potomac TRACON, endorsement at BWI, DCA, and IAD ATCTs must first be completed.</p>
    <p>Once again, congratulations on being accepted as a visitor to Washington ARTCC, and we hope to see you on the network soon! If you have any questions, feel free to email the DATM at <a href="mailto:datm@vzdc.org">datm@vzdc.org</a>.
    </p>

    <p>Best regards,</p>
    <p>ZDC Visiting Staff</p>
@endsection
