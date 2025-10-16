<?php

namespace App\Http\Controllers\Api;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Support Ticket API",
 *     description="API documentation for the Feedback-Ticket system built with Laravel",
 * )
 *
 * @OA\Server(
 *     url="http://localhost",
 *     description="Local development server"
 * )
 */
class SwaggerController
{
    /**
     * @OA\Post(
     *     path="/api/tickets",
     *     summary="Create a new support ticket",
     *     description="Submits a new ticket with contact details, message, and optional attachments.",
     *     tags={"Tickets"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *
     *             @OA\Schema(
     *                 required={"name", "email", "phone", "subject", "text"},
     *
     *                 @OA\Property( property="name", type="string", maxLength=255, example="John Doe", description="Customer name" ),
     *                 @OA\Property( property="email", type="string", format="email", maxLength=255, description="Customer email" ),
     *                 @OA\Property( property="phone", type="string", pattern="^\+[1-9]\d{1,14}$", example="+1234567890", description="Phone number in international E.164 format" ),
     *                 @OA\Property( property="subject", type="string", maxLength=255,  description="Short subject or title of the issue" ),
     *                 @OA\Property( property="text", type="string", description="Detailed message describing the issue" ),
     *                 @OA\Property(
     *                     property="files",
     *                     type="array",
     *                     maxItems=5,
     *                     description="Optional file attachments (max 5 files, up to 5MB each)",
     *
     *                     @OA\Items(
     *                         type="string",
     *                         format="binary",
     *                         description="File upload (jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt, zip)"
     *                     )
     *                 )
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Ticket successfully created",
     *
     *         @OA\JsonContent(
     *
     *             @OA\Property(property="message", type="string", example="Your feedback has been sent successfully"),
     *         )
     *     ),
     * )
     */
    public function storeTicket() {}

    /**
     * @OA\Get(
     *     path="/api/tickets/statistics",
     *     summary="Get ticket statistics",
     *     description="Returns total ticket counts for today, this week, and this month.",
     *     tags={"Tickets"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Successful response containing ticket statistics",
     *
     *         @OA\JsonContent(
     *             type="object",
     *
     *             @OA\Property(property="today", type="integer", example=5, description="Number of tickets created today"),
     *             @OA\Property(property="week", type="integer", example=24, description="Number of tickets created this week"),
     *             @OA\Property(property="month", type="integer", example=103, description="Number of tickets created this month")
     *         )
     *     )
     * )
     */
    public function ticketStatistics() {}
}
