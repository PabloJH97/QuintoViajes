import { TicketForm } from "@/pages/tickets/components/TicketForm";
import { TicketLayout } from "@/layouts/tickets/TicketLayout";
import { PageProps } from "@/types";
import { useTranslations } from "@/hooks/use-translations";

interface CreateTicketProps extends PageProps {
    seats: string;

  }

export default function CreateTicket({seats}:CreateTicketProps) {
  const { t } = useTranslations();

  const paramsString = window.location.search;
  const searchParams = new URLSearchParams(paramsString);
  const flightCode = searchParams.get('code');
  const flightSeats = searchParams.get('seats');

  return (
    <TicketLayout title={t("ui.tickets.create")}>
      <div className="p-6">
        <div className="max-w-xl">
          <TicketForm  pageTitle={t("ui.tickets.create")} flightCode={flightCode} seats={flightSeats}/>
        </div>
      </div>
    </TicketLayout>
  );
}
