<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function home(): View
    {
        return view('pages.home', [
            'title' => 'Home - PHEARUM',
            'posts' => array_slice($this->posts(), 0, 2),
            'experiments' => array_slice($this->experimentsData(), 0, 3),
        ]);
    }

    public function blog(): View
    {
        return view('pages.blog', [
            'title' => 'Blog - PHEARUM',
            'posts' => $this->posts(),
        ]);
    }

    public function post(string $id): View
    {
        $posts = $this->posts();
        abort_unless(isset($posts[$id]), 404);

        $relatedPosts = array_filter($posts, fn (array $post): bool => $post['id'] !== $id);

        return view('blog.show', [
            'title' => $posts[$id]['title'] . ' - PHEARUM',
            'post' => $posts[$id],
            'relatedPosts' => array_slice($relatedPosts, 0, 3),
        ]);
    }

    public function experiments(): View
    {
        return view('pages.experiments', [
            'title' => 'Experiments - PHEARUM',
            'experiments' => $this->experimentsData(),
        ]);
    }

    public function about(): View
    {
        return view('pages.about', [
            'title' => 'Positive Mindset - PHEARUM',
        ]);
    }

    public function contact(): View
    {
        return view('pages.contact', [
            'title' => 'Contact - PHEARUM',
        ]);
    }

    private function posts(): array
    {
        return [
            '1' => [
                'id' => '1',
                'title' => 'Feeling!',
                'subtitle' => 'A mountain valley with green hills',
                'date' => 'Oct 25, 2025',
                'image' => 'images/blog1.jpg',
                'alt' => 'Sunlit green mountain valley',
                'excerpt' => 'A calm mountain landscape that reminds us how nature can refresh the mind and inspire new energy.',
                'content' => [
                    'Nature has a unique way of calming the mind and refreshing the soul. This mountain landscape captures peaceful connection through rolling green hills, soft light, and distant peaks.',
                    'The vibrant green fields guide the eye into the scene, while sunlight breaking through clouds creates depth and a calm atmosphere.',
                    'Scenes like this remind us to preserve natural spaces and stay connected to the world around us.',
                ],
            ],
            '2' => [
                'id' => '2',
                'title' => 'Mind!',
                'subtitle' => 'Exploring the majestic fjords',
                'date' => 'Oct 20, 2025',
                'image' => 'images/blog2.jpg',
                'alt' => 'Blue fjord between green mountains',
                'excerpt' => 'A peaceful fjord scene with deep water, green mountains, and a reminder to think with clarity.',
                'content' => [
                    'Few places capture the imagination like a fjord landscape. Deep blue water, steep green mountains, and quiet movement create a strong feeling of scale.',
                    'The calm surface of the water contrasts with the height of the mountains, making the view feel powerful and peaceful at the same time.',
                    'Fjords are shaped by glaciers over long periods of time, which makes them both beautiful and scientifically interesting.',
                ],
            ],
            '3' => [
                'id' => '3',
                'title' => 'Look!',
                'subtitle' => 'Endless green fields and peaceful countryside',
                'date' => 'Oct 15, 2025',
                'image' => 'images/blog3.jpg',
                'alt' => 'Open green field under a blue sky',
                'excerpt' => 'Wide fields, soft clouds, and open sky create a simple reminder to slow down and observe.',
                'content' => [
                    'Wide-open fields can feel deeply calming. The green crops, bright sky, and distant hills create a simple but beautiful countryside view.',
                    'Agricultural landscapes are more than scenery. They support communities and remind us how closely people are connected to the land.',
                    'This kind of view is perfect for relaxation, reflection, and creative inspiration.',
                ],
            ],
            '4' => [
                'id' => '4',
                'title' => 'Sunrise Over the Mountains',
                'subtitle' => 'A calm morning view with light, color, and fresh air',
                'date' => 'Oct 10, 2025',
                'image' => 'images/blog4.jpg',
                'alt' => 'Warm mountain sunrise with layered peaks',
                'excerpt' => 'A sunrise scene that feels peaceful, fresh, and full of possibility.',
                'content' => [
                    'A mountain sunrise gives a quiet kind of energy. The air feels fresh, the sky changes every minute, and everything looks calm and clear.',
                    'Morning light reveals detail in the rocks, flowers, and distant hills. It also creates a strong feeling of renewal.',
                    'Simple moments in nature can feel powerful when we slow down enough to notice them.',
                ],
            ],
        ];
    }

    private function experimentsData(): array
    {
        return [
            [
                'emoji' => '🧠',
                'label' => 'Brain',
                'title' => 'Brain Teaser Challenge',
                'level' => 'Easy',
                'description' => 'Practice logic, pattern recognition, and critical thinking with a simple puzzle-style activity.',
                'learn' => 'Problem-solving, pattern recognition, critical thinking.',
                'action' => 'Start Experiment',
            ],
            [
                'emoji' => '🎨',
                'label' => 'Color',
                'title' => 'Color Psychology',
                'level' => 'Beginner',
                'description' => 'Explore how color choices can affect emotion, focus, and the feeling of a design.',
                'learn' => 'Color theory, emotional responses, design psychology.',
                'action' => 'Learn More',
            ],
            [
                'emoji' => '🧬',
                'label' => 'DNA',
                'title' => 'DNA & Genetics Basics',
                'level' => 'Intermediate',
                'description' => 'Understand the building blocks of life and learn how DNA affects heredity.',
                'learn' => 'Genetics, heredity, molecular biology basics.',
                'action' => 'Explore',
            ],
            [
                'emoji' => '⚛️',
                'label' => 'Physics',
                'title' => 'Physics in Motion',
                'level' => 'Intermediate',
                'description' => 'See physics in action through forces, motion, and energy examples.',
                'learn' => 'Newton laws, momentum, energy conservation.',
                'action' => 'Discover',
            ],
            [
                'emoji' => '🧠',
                'label' => 'Memory',
                'title' => 'Memory Palace Technique',
                'level' => 'Easy',
                'description' => 'Learn a classic memory method that helps ideas become easier to organize and remember.',
                'learn' => 'Memory techniques, mnemonics, learning strategies.',
                'action' => 'Try It',
            ],
            [
                'emoji' => '🌊',
                'label' => 'Ocean',
                'title' => 'Ocean & Climate Science',
                'level' => 'Beginner',
                'description' => 'Explore how oceans regulate climate and why they matter for life on Earth.',
                'learn' => 'Oceanography, climate systems, environmental science.',
                'action' => 'Learn',
            ],
        ];
    }
}
