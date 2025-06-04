import { TicketForm } from "@/pages/tickets/components/TicketForm";
import { TicketLayout } from "@/layouts/tickets/TicketLayout";
import { PageProps } from "@inertiajs/core";
import { useTranslations } from "@/hooks/use-translations";

interface EditTicketProps extends PageProps {
  ticket: {
    id: string;
  };
  page?: string;
  perPage?: string;
  user: string;
  flight: string;
}

export default function EditTicket({ ticket, page, perPage, user, flight }: EditTicketProps) {
  const { t } = useTranslations();
  return (
    <TicketLayout title={t("ui.tickets.edit")}>
      <div className="p-6">
        <div className="max-w-xl">
          <TicketForm
            initialData={ticket}
            page={page}
            perPage={perPage}
            user={user}
            flight={flight}
            pageTitle={t("ui.tickets.edit")}
          />
        </div>
      </div>
    </TicketLayout>
  );
}
