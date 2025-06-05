import { TicketForm } from "@/pages/tickets/components/TicketForm";
import { TicketLayout } from "@/layouts/tickets/TicketLayout";
import { PageProps } from "@/types";
import { useTranslations } from "@/hooks/use-translations";

interface CreateTicketProps extends PageProps {


  }

export default function CreateTicket({arrayPermissions}:CreateTicketProps) {
  const { t } = useTranslations();

  const paramsString = window.location.search;
  const searchParams = new URLSearchParams(paramsString);
  const flightCode = searchParams.get('code');

  return (
    <TicketLayout title={t("ui.tickets.create")}>
      <div className="p-6">
        <div className="max-w-xl">
          <TicketForm  pageTitle={t("ui.tickets.create")} flightCode={flightCode}/>
        </div>
      </div>
    </TicketLayout>
  );
}
