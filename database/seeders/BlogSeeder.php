<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    /**
     * Seeds 9 sample blog posts — 3 per category (Admit Card, Result, News).
     * Uses realistic job-portal content for immediate testability.
     *
     * Run: php artisan db:seed --class=BlogSeeder
     */
    public function run(): void
    {
        $blogs = [

            // ── Admit Card ────────────────────────────────────────────────────
            [
                'category'          => 'Admit Card',
                'title'             => 'SSC CGL 2024 Tier 1 Admit Card Released — Download Now',
                'short_description' => 'The Staff Selection Commission has officially released the Admit Card for SSC CGL 2024 Tier 1 examination. Candidates can download their hall tickets from the official SSC website using their registration number and date of birth.',
                'content'           => "The Staff Selection Commission (SSC) has released the Admit Card for the Combined Graduate Level (CGL) 2024 Tier 1 Examination. Candidates who had applied for the exam can now download their hall tickets from the official SSC portal.\n\nHow to Download SSC CGL 2024 Admit Card:\n1. Visit the official SSC website: ssc.nic.in\n2. Click on the 'Admit Card' section in the navigation menu\n3. Select 'SSC CGL 2024 Tier 1 Admit Card'\n4. Enter your Registration Number and Date of Birth\n5. Click on 'Submit' and download your admit card\n6. Take a printout for examination day\n\nImportant Details:\n- Exam Date: As per schedule\n- Exam Mode: Computer Based Test (CBT)\n- Reporting Time: 30 minutes before exam start\n- Documents Required: Admit Card + Valid Photo ID\n\nNote: Candidates must carry a valid government-issued photo ID (Aadhaar, PAN, Passport, Voter ID) along with the admit card on the day of examination. Mobile phones and electronic devices are strictly prohibited inside examination halls.",
            ],
            [
                'category'          => 'Admit Card',
                'title'             => 'UPSC Civil Services Prelims 2024 Admit Card Available for Download',
                'short_description' => 'UPSC has published the e-Admit Card for Civil Services (Preliminary) Examination 2024. Candidates can access their admit cards through the UPSC official website. The examination is scheduled to be held at various centres across India.',
                'content'           => "The Union Public Service Commission (UPSC) has made available the e-Admit Card for the Civil Services (Preliminary) Examination 2024. All registered candidates are advised to download and verify their admit cards well in advance.\n\nSteps to Download UPSC Prelims 2024 Admit Card:\n1. Navigate to the official UPSC website: upsc.gov.in\n2. Click on 'e-Admit Card' under the 'Examinations' tab\n3. Select 'Civil Services (Preliminary) Examination, 2024'\n4. Enter your Registration ID / Roll Number\n5. Enter your Date of Birth and click 'Submit'\n6. Download and print the admit card\n\nExamination Schedule:\n- Paper 1 (General Studies): 9:30 AM to 11:30 AM\n- Paper 2 (CSAT): 2:30 PM to 4:30 PM\n\nImportant Instructions:\n- Candidates must report at least 30 minutes before the scheduled start\n- Paste recent passport-size photograph if not already uploaded online\n- Carry at least two valid photo identity proofs\n- Electronic devices including smartwatches are strictly prohibited\n\nFor any technical difficulty in downloading the admit card, candidates may contact UPSC Facilitation Counter.",
            ],
            [
                'category'          => 'Admit Card',
                'title'             => 'Railway RRB NTPC 2024 CBT-1 Admit Card — Zone-wise Download Links',
                'short_description' => 'The Railway Recruitment Boards have released the Admit Card for RRB NTPC 2024 CBT-1 exam. Candidates must download their admit card from their respective RRB regional website using their registration number.',
                'content'           => "Railway Recruitment Boards (RRBs) have officially released the Admit Card for the Non-Technical Popular Category (NTPC) 2024 Computer Based Test (CBT) Stage 1. Candidates appearing in the examination can download their hall tickets from the respective regional RRB websites.\n\nZone-wise Official Websites:\n- RRB Ahmedabad: rrbahmedabad.gov.in\n- RRB Allahabad: rrbald.gov.in\n- RRB Bangalore: rrbbnc.gov.in\n- RRB Bhopal: rrbbpl.nic.in\n- RRB Chennai: rrbchennai.gov.in\n- RRB Delhi: rrbdelhiold.gov.in\n- RRB Mumbai: rrbmumbai.gov.in\n\nHow to Download:\n1. Go to your respective RRB regional website\n2. Click on 'Download Admit Card' link\n3. Enter Registration Number and Date of Birth\n4. Download and take printout\n\nExam Day Instructions:\n- Report 60 minutes before exam start time\n- Carry original photo ID proof\n- Black/blue ballpoint pen for rough work\n- Scribe/Writer rules apply as per official guidelines\n\nThe exam is being held in multiple shifts across various cities. Candidates are advised to check their exam city and date carefully before proceeding.",
            ],

            // ── Result ────────────────────────────────────────────────────────
            [
                'category'          => 'Result',
                'title'             => 'SSC CHSL 2023 Final Result Declared — Check Selected Candidates List',
                'short_description' => 'The Staff Selection Commission has announced the Final Result for CHSL (Combined Higher Secondary Level) 2023. The result is now available on the official SSC website. Candidates who appeared in the Skill Test can check their result using their roll number.',
                'content'           => "The Staff Selection Commission (SSC) has officially declared the Final Result for the Combined Higher Secondary Level (CHSL) Examination 2023. Candidates who appeared in the Skill Test / Typing Test can now check their selection status on the official SSC portal.\n\nHow to Check SSC CHSL 2023 Final Result:\n1. Visit ssc.nic.in\n2. Navigate to 'Results' section in the top menu\n3. Click on 'CHSL 2023 Final Result'\n4. A PDF file will open with the list of selected candidates\n5. Use Ctrl+F to search your Roll Number in the document\n\nPost Selection Process:\n- Document Verification will be conducted shortly\n- Selected candidates will receive posting orders after DV\n- Original certificates must be submitted during DV\n\nRequired Documents for DV:\n- 10th and 12th Mark Sheets and Certificates\n- Date of Birth Certificate\n- Category Certificate (if applicable)\n- Passport size photographs\n- Character Certificate from a Gazetted Officer\n- NOC from current employer (if employed)\n\nImportant: Candidates whose names appear in the merit list are advised to keep all original documents ready. The commission reserves the right to cancel the candidature at any stage if discrepancy is found in documents.",
            ],
            [
                'category'          => 'Result',
                'title'             => 'IBPS PO 2024 Mains Result Out — Provisional Allotment Released',
                'short_description' => 'IBPS has declared the IBPS PO (Probationary Officer) 2024 Mains examination result along with provisional allotment to participating banks. Candidates can check their result on the official IBPS website by logging in with their credentials.',
                'content'           => "The Institute of Banking Personnel Selection (IBPS) has declared the result of CRP PO/MT-XIV (Probationary Officer / Management Trainee) Mains examination along with the provisional allotment list. Candidates who appeared in the IBPS PO Mains 2024 can now check their result and bank allotment.\n\nHow to Check IBPS PO Mains 2024 Result:\n1. Visit the official IBPS website: ibps.in\n2. Click on 'CRP PO/MT' link\n3. Select 'Result' from the dropdown\n4. Login with your Registration Number and Password/Date of Birth\n5. Your result and allotment details will be displayed\n6. Download and save for future reference\n\nCut-off Marks (General Category — Indicative):\n- Reasoning: 12–15 marks\n- English Language: 8–12 marks\n- Data Analysis: 10–14 marks\n- General/Economy/Banking Awareness: 14–18 marks\n- Overall: 85–100 marks (varies by state)\n\nParticipating Banks:\n- State Bank of India is not part of IBPS allotment\n- Allahabad Bank, Bank of Baroda, Bank of India, Canara Bank, Central Bank of India, Indian Bank, Punjab National Bank, UCO Bank, Union Bank of India\n\nNext Steps for Selected Candidates:\n- Check bank-specific joining notification\n- Complete online joining formalities as per allotted bank\n- Pre-joining medical examination may be required",
            ],
            [
                'category'          => 'Result',
                'title'             => 'UP Police Constable 2024 Written Exam Result — Merit List Published',
                'short_description' => 'Uttar Pradesh Police Recruitment and Promotion Board (UPPRPB) has published the Written Examination Result for UP Police Constable 2024. Over 48,000 vacancies were announced. Shortlisted candidates will be called for Physical Efficiency Test (PET).',
                'content'           => "The Uttar Pradesh Police Recruitment and Promotion Board (UPPRPB) has officially declared the result of the Written Examination for UP Police Constable Civil Police 2024. Candidates who appeared in the examination can now check their result status on the official board website.\n\nHow to Check UP Police Constable 2024 Result:\n1. Visit the official UPPRPB portal: uppbpb.gov.in\n2. Click on 'Result' section\n3. Select 'Constable Civil Police Written Exam Result 2024'\n4. Enter your Application Number and Date of Birth\n5. Submit and view your result\n\nVacancy Details:\n- Total Vacancies: 60,244 Posts\n- Civil Police: 52,699\n- PAC: 7,545\n\nSelection Stages:\n1. Written Examination (Completed)\n2. Physical Efficiency Test (PET) — Upcoming\n3. Physical Standard Test (PST)\n4. Document Verification\n5. Medical Examination\n\nPET Details for Shortlisted Candidates:\n- Male: 4.8 km run in 25 minutes\n- Female: 2.4 km run in 14 minutes\n- High Jump, Long Jump, Shot Put events\n\nCandidates are advised to start physical preparation immediately as the PET dates will be announced shortly. Only those who qualify the written exam will be eligible to appear in PET.",
            ],

            // ── News ──────────────────────────────────────────────────────────
            [
                'category'          => 'News',
                'title'             => 'Central Government Announces 75,000 New Vacancies in Various Departments',
                'short_description' => 'The Central Government has announced a major recruitment drive with over 75,000 vacancies across multiple ministries and departments including Railways, Defence, Banking, and SSC. This is the largest recruitment announcement of the year.',
                'content'           => "The Central Government has unveiled a massive recruitment drive announcing over 75,000 new vacancies across various central government departments, ministries, and public sector undertakings. This announcement brings great news for millions of job seekers across the country.\n\nBreakdown of Vacancies by Department:\n- Indian Railways: 25,000+ posts (NTPC, Group D, ALP)\n- SSC (Staff Selection Commission): 15,000+ posts (CGL, CHSL, MTS)\n- Banking Sector (IBPS, SBI): 12,000+ posts (PO, Clerk, SO)\n- Defence (Army, Navy, Air Force): 10,000+ posts\n- UPSC (Civil Services, IFS): 1,105 posts\n- Central Armed Police Forces: 8,000+ posts\n- Other Ministries: 3,895 posts\n\nEligibility Overview:\n- Educational Qualification: 10th to Post-Graduation (varies by post)\n- Age Limit: 18–45 years (relaxation for reserved categories)\n- Nationality: Indian citizens only (some posts require additional criteria)\n\nApplication Timeline:\n- Notifications: Being released phase-wise starting this month\n- Application Mode: Online only through respective official portals\n- Exam Mode: Computer Based Test (CBT) / Written\n\nExperts believe this is a significant step towards fulfilling the government's promise of expanding public sector employment. Aspirants are advised to regularly check official portals and register for job alerts on JobYaari Blogs.",
            ],
            [
                'category'          => 'News',
                'title'             => 'NTA Announces Revised NEET 2025 Exam Date and New Guidelines',
                'short_description' => 'The National Testing Agency (NTA) has officially announced the revised exam date for NEET UG 2025 along with new examination guidelines. The exam will be held in pen-and-paper mode at designated centres. Students should note the updated schedule.',
                'content'           => "The National Testing Agency (NTA) has officially announced key updates regarding the NEET UG 2025 examination including revised dates, new guidelines, and changes to the examination pattern following recommendations from expert committees.\n\nKey Announcements:\n\n1. Revised Exam Date:\nNEET UG 2025 is scheduled to be conducted on the first Sunday of May 2025. The exact date will be confirmed in the official notification.\n\n2. Examination Pattern Changes:\n- Total Questions: 180 (45 per subject)\n- Total Marks: 720\n- Subjects: Physics, Chemistry, Botany, Zoology\n- Duration: 3 hours 20 minutes\n- No internal choice in questions (revised from 2024 pattern)\n\n3. New Security Measures:\n- Bio-metric verification at examination centres\n- CCTV surveillance mandatory at all centres\n- Metal detectors and jammers installed\n- Observer deployment increased by 40%\n\n4. Application Process Updates:\n- Online application window: 30 days from notification\n- Application fee: Rs. 1,700 (General), Rs. 1,600 (OBC), Rs. 1,000 (SC/ST/PwD)\n- City intimation slip will be issued 3 weeks before exam\n\n5. Admit Card:\n- Available 7–10 days before examination\n- Mandatory to carry with valid photo ID\n\nStudents are advised to download the official information bulletin from the NTA website (nta.ac.in) for complete details. JobYaari Blogs will keep you updated with all NEET 2025 developments.",
            ],
            [
                'category'          => 'News',
                'title'             => 'EPFO Launches New Digital Services: Now Apply for PF Withdrawal Online',
                'short_description' => 'The Employees Provident Fund Organisation (EPFO) has launched upgraded digital services allowing members to apply for PF withdrawal, pension claims, and transfers entirely online. The new portal features a simplified interface and faster processing times.',
                'content'           => "The Employees Provident Fund Organisation (EPFO) has launched a revamped digital services platform that significantly simplifies the process of applying for PF withdrawal, pension claims, advance withdrawals, and fund transfers. The new system promises faster processing and greater transparency.\n\nNew Features of EPFO Digital Portal:\n\n1. Online PF Withdrawal:\n- Full settlement claims now processed within 3 working days\n- Partial withdrawal (advance) approved within 24 hours for medical emergencies\n- Aadhaar-based OTP verification for instant authentication\n\n2. Unified Member Portal (UAN Portal) Upgrades:\n- New dashboard showing real-time claim status\n- SMS and email alerts at every processing stage\n- Document upload facility for supporting documents\n\n3. Pension (EPS) Claims:\n- Early pension, reduced pension, widow pension claims now online\n- Pensioners can update bank details without visiting office\n\n4. Transfer Claims:\n- One-click transfer when changing jobs\n- Auto-transfer trigger upon new employment registration\n\nHow to Use the New Portal:\n1. Login at unifiedportal-mem.epfindia.gov.in\n2. Verify your Aadhaar and Bank account are linked (mandatory)\n3. Go to 'Online Services' → 'Claim (Form-31, 19, 10C & 10D)'\n4. Select claim type and follow the guided steps\n5. Submit and track your claim in real-time\n\nThis initiative is expected to benefit over 6 crore active EPFO members across India. For any queries, members can contact the EPFO helpline at 1800-118-005 (toll-free).",
            ],
        ];

        // ── Insert blogs with auto-generated slugs ────────────────────────────
        foreach ($blogs as $data) {
            $slug = Str::slug($data['title']);

            // Fetch or create the category
            $category = \App\Models\Category::firstOrCreate(
                ['name' => $data['category']],
                ['slug' => Str::slug($data['category'])]
            );

            // Ensure slug uniqueness if seeder is run multiple times
            $existingCount = Blog::where('slug', 'LIKE', $slug . '%')->count();
            if ($existingCount > 0) {
                $slug .= '-' . ($existingCount + 1);
            }

            Blog::updateOrCreate(
                ['slug' => Str::slug($data['title'])], // Match by original slug
                [
                    'title'             => $data['title'],
                    'slug'              => Str::slug($data['title']),
                    'short_description' => $data['short_description'],
                    'content'           => $data['content'],
                    'category_id'       => $category->id,
                    'status'            => 'Active',
                    'image'             => null, // No image for seeds; placeholder URL used via accessor
                ]
            );
        }

        $this->command->info('✅ 9 sample blogs seeded (3 per category).');
    }
}
